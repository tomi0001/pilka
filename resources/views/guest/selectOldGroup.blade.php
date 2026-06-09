
<select name="old" id="old" class="block w-full ounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 form-select-group" onchange="changeSession('{{ route('guest.changeSeession') }}', this.value,'{{ $route   }}')">

    <option value="0" {{   session()->get('oldGroup') == 0 ? 'selected' : '' }}>Grupa teraźniejsza</option>
    @foreach($listOldGroup as $item)

        <option value="{{ $item->type }}" {{   session()->get('oldGroup') == $item->type ? 'selected' : '' }}>Grupa {{ $item->type }}</option>
    @endforeach
</select>

