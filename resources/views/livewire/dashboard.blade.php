<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @unless ($file)
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400" id="file-name"></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">(CSV)</p>
                        </div>
                        <!-- <input id="dropzone-file" type="file" class="hidden" wire:change="$emit('upload-file', $event)" wire:drop="$emit('upload-file', $event)" /> -->
                        <input id="dropzone-file" type="file" class="hidden" wire:model="file" wire:change="$emit('upload-file', $event)" wire:drop="$emit('upload-file', $event)" />
                        @error('file')
                        <p class="text-red-500">The selected file type should be csv</p>
                        @enderror
                    </label>
                </div>
            @else
            <form wire:submit.prevent="uploadFile">
                <div class="mx-5">

                    <div class="grid gap-6 mb-6 md:grid-cols-2 py-5">
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
                            <select type="text" wire:model="mapColumnField.first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John">
                                <option value="" disabled>Select</option>
                                @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                                @endforeach
                            </select>
                            <div class="text-red-500">@error('mapColumnField.first_name')  {{ $errors->first('mapColumnField.first_name') }} @enderror</div>
                        </div>
                        <div>
                            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
                            <select type="text" wire:model="mapColumnField.last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Doe">
                                <option value="" disabled>Select</option>
                                @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                                @endforeach
                            </select>
                            <div class="text-red-500">@error('mapColumnField.last_name')  {{ $errors->first('mapColumnField.last_name') }} @enderror</div>
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <select type="text" wire:model="mapColumnField.email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Flowbite">
                                <option value="" disabled>Select</option>
                                @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                                @endforeach
                            </select>
                            <div class="text-red-500">@error('mapColumnField.email')  {{ $errors->first('mapColumnField.email') }} @enderror</div>
                        </div>
                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number</label>
                            <select type="tel" wire:model="mapColumnField.phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
                                <option value="" disabled>Select</option>
                                @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                                @endforeach
                            </select>
                            <div class="text-red-500">@error('mapColumnField.phone')  {{ $errors->first('mapColumnField.phone') }} @enderror</div>
                        </div>

                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                            <select type="tel" wire:model="mapColumnField.created_at" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
                                <option value="" disabled>Select</option>
                                @foreach ($columns as $column)
                                <option>{{ $column }}</option>
                                @endforeach
                            </select>
                            <div class="text-red-500">@error('mapColumnField.created_at')  {{ $errors->first('mapColumnField.created_at') }} @enderror</div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end p-5 ">
                    <button wire:click="$set('file', null)" class="border border-grey-400 mr-3 text-grey bg-grey-700 hover:bg-grey-800 focus:ring-4 focus:outline-none focus:ring-grey-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-grey-600 dark:hover:bg-grey-700 dark:focus:ring-grey-800">Cancel</button>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Import</button>

                </div>
            </form>

            @endunless

            <!-- @foreach ($mapColumnField as $p=>$k)
                <p>{{$p}} : {{ $k}}</p>
            @endforeach -->
        </div>
    </div>
</div>

<script>
    Livewire.on('upload-file', (e) => {
        let files = e.target.files;
        let fileObject = files[0];
        document.getElementById('file-name').innerText = fileObject.name
        console.log(document.getElementById('file-name'))
        console.log(fileObject.name)
        // // window.livewire.emit('file-upload', fileObject)
        // let reader = new FileReader();
        // reader.onloadend = () => {
        //     // console.log(reader.result)
        //         // window.livewire.emit('file-upload', reader.result)
        //     }
        // reader.readAsDataURL(fileObject);
    })
</script>