<x-blade-ui-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Terdaftar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                <x-bladewind::alert
                    shade="dark"
                    show_icon="false"
                    show_close_icon="false">
                    Menambah user melalu link Registrasi, user login harus <a href="{{ route('logout') }}" class="!text-white/70">Logout</a> terlebih dahulu
                </x-bladewind::alert>

                <x-bladewind::table>
                    <x-slot name="header">
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Aksi</th>
                    </x-slot>

                    @foreach($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <!-- <x-bladewind::button.circle icon="pencil-square" color="orange" size="tiny" /> -->

                            <a href="{{ route('user.delete', ['id'=> $item->id]) }}">
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
