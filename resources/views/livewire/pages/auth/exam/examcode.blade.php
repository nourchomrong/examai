 <!-- Form starts -->
                    <form wire:submit.prevent="joinExam">
                        <!-- Exam Code -->
                        <x-label for="exam_code">Enter Exam Code</x-label>
                        <x-input type="text" wire:model.defer="exam_code" placeholder="Enter Exam Code"/>
                        <x-input-error field="exam_code" />

                        <!-- Join error -->
                        @if($joinError)
                            <p class="text-red-500 text-sm mt-3 text-center">{{ $joinError }}</p>
                        @endif
                        <!-- Login Button -->
                        <button type="submit"
                            class="mt-16 w-full py-4 bg-indigo-500 text-white rounded-lg flex justify-center items-center gap-2"
                            wire:loading.attr="disabled" wire:target="joinExam">
                            <span wire:loading.remove wire:target="joinExam">Join Exam</span>
                            <span wire:loading wire:target="joinExam">Joining...</span>
                        </button>

                    </form>
                    <!-- Form ends -->