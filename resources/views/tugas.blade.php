<x-blade-ui-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Tugas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($edit)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('tugas.update', ['id' => $item->id]) }}">
                        @csrf
                        <x-bladewind::input label="Label Tugas" name="judul" selected_value="{{ $item->judul }}"/>
                        <x-bladewind::textarea label="Deskripsi" name="deskripsi" selected_value="{{ $item->deskripsi }}"/>

                        <x-bladewind::select
                            name="status"
                            selected_value="{{ $item->status }}"
                            label="Status Tugas"
                            :data="$status" />

                        <x-bladewind::select
                            name="kategori_id"
                            selected_value="{{ $item->kategori_id }}"
                            label="Pilih Kategori"
                            :data="$kategori" />

                        <x-bladewind::button can_submit="true" class="w-full mt-2">
                            Siman Data
                        </x-bladewind::button>
                    </form>
                </div>
            </div>
            <br>
            @endif
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
                    
                <x-bladewind::button icon="plus" color="blue" onclick="showModal('new-tugas')">
                    Tugas Baru
                </x-bladewind::button>

                <x-bladewind::modal name="new-tugas" title="Buat Kategori Baru" ok_button_label="">
                    <form method="post" action="{{ route('tugas.new') }}">
                        @csrf
                        <x-bladewind::input label="Label Tugas" name="judul"/>
                        <x-bladewind::textarea label="Deskripsi" name="deskripsi"/>

                        <x-bladewind::select
                            name="status"
                            label="Status Tugas"
                            :data="$status" />

                        <x-bladewind::select
                            name="kategori_id"
                            label="Pilih Kategori"
                            :data="$kategori" />

                        <x-bladewind::button can_submit="true" class="w-full mt-2">
                            Siman Data
                        </x-bladewind::button>
                    </form>
                </x-bladewind::modal>

                <x-bladewind::table>
                    <x-slot name="header">
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Oleh</th>
                        <th>Created at</th>
                        <th>Aksi</th>
                    </x-slot>

                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('tugas.edit', ['id'=> $item->id]) }}">
                                <x-bladewind::button.circle icon="pencil-square" color="orange" size="tiny" />
                            </a>

                            <a href="{{ route('tugas.delete', ['id'=> $item->id]) }}">
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
