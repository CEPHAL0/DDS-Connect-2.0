<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Response;
use App\Models\ResponseUser;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResponseController extends Controller
{
    public function index()
    {
        $forms = Form::latest()->get();
        $responseUsers = ResponseUser::latest()->take(3)->get();
        return view("admin.responses.index", compact("responseUsers", "forms"));
    }

    public function showResponse(int $formId)
    {
        $form = Form::with(["responseUsers", "responseUsers.responses"])->findOrFail($formId);


        return view("admin.responses.show", compact("form"));
    }

    public function export(int $formId)
    {
        try {
            $form = Form::findOrFail($formId);
            $responseUsers = $form->responseUsers;

            $columns[] = [];


            $questions = $form->questions;

            foreach ($questions as $index => $question) {
                $columns[0][$index] = $question->question;
                $columns[1][$index] = $question->id;
            }

            foreach ($responseUsers as $indexResponseUser => $responseUser) {
                foreach ($responseUser->responses as $indexResponse => $response) {
                    $correctResponse = Response::where("id", $response->id)->whereIn("question_id", $columns[1])->first();
                    $columns[$indexResponseUser + 2][$indexResponse] = $correctResponse->answer;
                }
            }

            $fileName = $form->title . " " . Carbon::now() . ".csv";

            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"$fileName\"",
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0',
            ];

            return response()->stream(function () use ($columns) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, $columns[0]);


                foreach ($columns as $index => $column) {
                    if ($index > 1) {
                        fputcsv($handle, $column);
                    }
                }
            }, 200, $headers);

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(["error" => "Failed to Export CSV"]);
        }
    }
}
