@extends('layouts.admin.app')

@section('styles')
    <style>
        .border-bottom {
            border-bottom: 1px solid;
        }

        .border-bottom:focus {
            outline: none;
        }
    </style>
@endsection

@section('title', 'Add Questions to Form')

@section('content')

    <div class="flex flex-col gap-6 items-center">
        <div class="flex flex-col items-center">
            <h1 class="font-bold text-3xl">Add Questions</h1>
            <h2 class="italic text-gray-600">{{ $form->title }}</h2>
        </div>

        <form action="{{ route('forms.storeQuestions', $form->id) }}" method="POST" class="flex flex-col gap-4" id="form">
            @csrf
            @method('POST')
            <div class="flex flex-col gap-3 w-[30vw] mt-[3px]" id="question-form">
                <div class="question-group flex flex-col gap-4 bg-gray-100 p-4 rounded-md border border-black">
                    <input type="text" placeholder="Question" name="questions[]"
                        class="px-4 py-2 rounded-md border border-black" required>
                    <select name="type[]" class="px-4 py-2 border border-black appearance-none rounded-md questionSelect"
                        data-select-index="0">
                        <option value="single">Single</option>
                        <option value="multiple">Multiple</option>
                        <option value="short">Short</option>
                        <option value="long">Long</option>
                    </select>

                    <div class="value-group flex flex-col gap-2">
                        <div class="flex items-center gap-2">
                            <input type="text" name="values[0][]" placeholder="Value"
                                class="px-4 py-2 border-bottom border-black w-32 focus:border-none value rounded-t-md"
                                required>
                            <button type="button" class="removeValue">
                                <span class="material-symbols-outlined bg-red-500 p-1 rounded-full text-white">
                                    delete
                                </span>
                            </button>
                        </div>
                    </div>
                    <button type="button"
                        class="bg-black px-2 py-1 rounded-md text-sm text-white focus:ring-2 ring-darkGreen ring-offset-1 w-fit addValue"
                        data-question-index="0">Add Value</button>

                    <button type="button" class="bg-red-600 text-white px-3 py-[0.35rem] rounded-md removeQuestion">Remove
                        Question</button>
                </div>


            </div>
            <button type="button" class="border border-black px-3 py-2 rounded-md " id="addQuestion">Add
                Question</button>

            <button type="submit" class="bg-black px-3 py-2 rounded-md text-white focus:ring-2 ring-black ring-offset-1"
                id="submitForm">Create
                Form</button>
        </form>

    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let questionIndex = 1;

            $("#addQuestion").click(function() {
                let newQuestionGroup = `
                <div class="question-group flex flex-col gap-4 bg-gray-100 p-4 rounded-md border border-black">
                    <input type="text" placeholder="Question" name="questions[]"
                        class="px-4 py-2 rounded-md border border-black" required>
                    <select name="type[]" class="px-4 py-2 border border-black appearance-none rounded-md questionSelect" data-select-index=${questionIndex}>
                        <option value="single">Single</option>
                        <option value="multiple">Multiple</option>
                        <option value="short">Short</option>
                        <option value="long">Long</option>
                    </select>

                   
                    <div class="value-group flex flex-col gap-2">
                        <div class="flex items-center gap-2">
                            <input type="text" name="values[${questionIndex}][]" placeholder="Value"
                                class="px-4 py-2 border-bottom border-black w-32 focus:border-none value rounded-t-md" required>
                            <button type="button" class="removeValue">
                                <span class="material-symbols-outlined bg-red-500 p-1 rounded-full text-white">
                                    delete
                                </span>
                            </button>
                        </div>
                    </div>

                    <button type="button"
                        class="bg-black px-2 py-1 rounded-md text-sm text-white focus:ring-2 ring-darkGreen ring-offset-1 w-fit addValue"
                        data-question-index="${questionIndex}">Add Value</button>

                    <button type="button" class="bg-red-600 text-white px-3 py-[0.35rem] rounded-md removeQuestion">Remove
                        Question</button>
                </div>`;
                $("#question-form").append(newQuestionGroup);
                questionIndex++;
            });

            // Function to add a new value field within a question group
            $(document).on("click", ".addValue", function() {
                let questionIndex = $(this).data('question-index');
                let newValueField = `
                     <div class="flex items-center gap-2">
                            <input type="text" name="values[${questionIndex}][]" placeholder="Value"
                                class="px-4 py-2 border-bottom border-black w-32 focus:border-none value rounded-t-md" required>
                            <button type="button" class="removeValue">
                                <span class="material-symbols-outlined bg-red-500 p-1 rounded-full text-white">
                                    delete
                                </span>
                            </button>
                        </div>
                `;

                $(this).siblings(".value-group").append(newValueField);
            });


            $(document).on("click", ".removeValue", function() {
                $(this).parent().remove();
            })


            $(document).on("change", ".questionSelect", function() {
                var value = $(this).find(":selected").val();
                if (value == "short" || value == "long") {
                    $(this).siblings(".value-group").hide();
                    $(this).siblings(".addValue").hide();
                } else {
                    $(this).siblings(".value-group").show();
                    $(this).siblings(".addValue").show();

                }
            })


            $(document).on("click", ".removeQuestion", function() {
                $(this).parent().remove();
            })


            $("#submitForm").click(function() {
                $("#form").submit();
            })
        });
    </script>
@endsection
