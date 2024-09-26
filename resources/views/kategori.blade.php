<x-blade-ui-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kategori Tugas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <x-bladewind::alert type="error">
                                {{ $error }}
                            </x-bladewind::alert>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    
                <x-bladewind::button icon="plus" color="blue" onclick="showModal('new-kategori')">
                    New Kategori
                </x-bladewind::button>

                <x-bladewind::modal name="new-kategori" title="Buat Kategori Baru" ok_button_label="">
                    <form method="post" action="{{ route('kategori.new') }}">
                        @csrf
                        <x-bladewind::input label="Label Kategori" name="judul"/>
                        <x-bladewind::button can_submit="true" class="w-full mt-2">
                            Siman Data
                        </x-bladewind::button>
                    </form>
                </x-bladewind::modal>

                <x-bladewind::table>
                    <x-slot name="header">
                        <th>Name</th>
                        <th>Created at</th>
                        <th>Aksi</th>
                    </x-slot>

                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <!-- <x-bladewind::button.circle icon="pencil-square" color="orange" size="tiny" /> -->

                            <a href="{{ route('kategori.delete', ['id'=> $item->id]) }}">
                                <x-bladewind::button.circle icon="trash" color="red" size="tiny" />
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </x-bladewind::table>
                </div>
            </div>
        </div>
    </div>
</x-blade-ui-layout>
