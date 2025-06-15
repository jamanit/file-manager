@props([
    'label' => 'Multiple Select Options',
    'name' => 'values',
    'options' => [],
])

<div>
    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
        {{ $label }}
    </label>
    <div>
        <select class="hidden" x-cloak id="select_{{ $name }}">
            @foreach ($options as $option)
                <option value="{{ $option['value'] }}">{{ $option['text'] }}</option>
            @endforeach
        </select>

        <div x-data="dropdown('{{ $name }}')" x-init="loadOptions()" class="flex flex-col items-center">
            <template x-for="(value, index) in selectedValuesArray()" :key="index">
                <input type="hidden" name="{{ $name }}[]" :value="value" />
            </template>

            <div class="relative z-20 inline-block w-full">
                <div class="relative flex flex-col items-center">
                    <div @click="open" class="w-full">
                        <div class="shadow-theme-xs focus:border-brand-300 focus:shadow-focus-ring dark:focus:border-brand-300 flex h-11 rounded-lg border border-gray-300 py-1.5 pr-3 pl-3 outline-hidden transition dark:border-gray-700 dark:bg-gray-900">
                            <div class="flex flex-auto flex-wrap gap-2">
                                <template x-for="(option,index) in selected" :key="index">
                                    <div class="group flex items-center justify-center rounded-full border-[0.7px] border-transparent bg-gray-100 py-1 pr-2 pl-2.5 text-sm text-gray-800 hover:border-gray-200 dark:bg-gray-800 dark:text-white/90 dark:hover:border-gray-800">
                                        <div class="max-w-full flex-initial" x-text="options[option].text"></div>
                                        <div class="flex flex-auto flex-row-reverse">
                                            <div @click="remove(index,option)" class="cursor-pointer pl-2 text-gray-500 group-hover:text-gray-400 dark:text-gray-400">
                                                <svg class="fill-current" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M3.41 4.47C3.11 4.18 3.11 3.7 3.41 3.41C3.7 3.12 4.17 3.12 4.47 3.41L7 5.94L9.53 3.41C9.82 3.12 10.3 3.12 10.59 3.41C10.88 3.7 10.88 4.18 10.59 4.47L8.06 7L10.59 9.53C10.88 9.82 10.88 10.3 10.59 10.59C10.3 10.88 9.82 10.88 9.53 10.59L7 8.06L4.47 10.59C4.17 10.88 3.7 10.88 3.41 10.59C3.11 10.3 3.11 9.82 3.41 9.53L5.94 7L3.41 4.47Z"
                                                        fill="" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <div x-show="selected.length == 0" class="flex-1">
                                    <input placeholder="Select option" class="h-full w-full appearance-none border-0 bg-transparent p-1 pr-2 text-sm outline-hidden placeholder:text-gray-800 focus:ring-0 dark:placeholder:text-white/90" />
                                </div>
                            </div>
                            <div class="flex w-7 items-center py-1 pr-1 pl-1">
                                <button type="button" @click="open" class="h-5 w-5 cursor-pointer text-gray-700 outline-hidden focus:outline-hidden dark:text-gray-400" :class="isOpen() ? 'rotate-180' : ''">
                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <path d="M4.79 7.4L10 12.6L15.21 7.4" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-4">
                        <div x-show.transition.origin.top="isOpen()" class="mt-2 max-h-select absolute top-full left-0 z-40 w-full overflow-y-auto rounded-lg bg-white shadow-sm dark:bg-gray-900" @click.outside="close">
                            <div class="flex w-full flex-col">
                                <template x-for="(option,index) in options" :key="index">
                                    <div>
                                        <div class="hover:bg-primary/5 w-full cursor-pointer border-b border-gray-200 dark:border-gray-800" @click="select(index, $event)">
                                            <div :class="option.selected ? 'border-primary' : ''" class="relative flex w-full items-center border-l-2 border-transparent p-2 pl-2">
                                                <div class="mx-2 leading-6 text-gray-800 dark:text-white/90" x-text="option.text"></div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @error($name)
            <span class="text-theme-xs text-error-500">{{ $message }}</span>
        @enderror
    </div>
</div>

@once
    <script>
        function dropdown(name) {
            return {
                options: [],
                selected: [],
                show: false,
                open() {
                    this.show = true;
                },
                close() {
                    this.show = false;
                },
                isOpen() {
                    return this.show === true;
                },
                select(index, event) {
                    if (!this.options[index].selected) {
                        this.options[index].selected = true;
                        this.selected.push(index);
                    } else {
                        this.selected.splice(this.selected.lastIndexOf(index), 1);
                        this.options[index].selected = false;
                    }
                },
                remove(index, option) {
                    this.options[option].selected = false;
                    this.selected.splice(index, 1);
                },
                loadOptions() {
                    const options = document.getElementById("select_" + name).options;
                    for (let i = 0; i < options.length; i++) {
                        this.options.push({
                            value: options[i].value,
                            text: options[i].innerText,
                            selected: options[i].getAttribute("selected") !== null,
                        });
                        if (options[i].getAttribute("selected") !== null) {
                            this.selected.push(i);
                        }
                    }
                },
                selectedValuesArray() {
                    return this.selected.map(index => this.options[index].value);
                },
            }
        }
    </script>
@endonce
