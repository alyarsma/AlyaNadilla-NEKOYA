@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-white px-6 pt-20 pb-16 text-slate-900 dark:bg-slate-900 dark:text-white">
    <div class="mx-auto max-w-7xl">

        <div class="mb-8 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-widest text-cyan-300">
                    Admin Panel
                </p>
                <h1 class="mt-2 text-3xl font-bold">
                    Data <span class="text-pink-400">Costume</span>
                </h1>
            </div>

            <a href="{{ route('costumes.create') }}"
               class="rounded-full bg-pink-500 px-6 py-3 font-semibold text-white hover:bg-cyan-400">
                + Tambah Produk
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-green-600 px-5 py-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM SEARCH AJAX --}}
        <div class="mb-6">
            <input
                type="text"
                id="searchInput"
                placeholder="Cari costume berdasarkan nama, kategori, ukuran..."
                class="w-full rounded-xl border border-cyan-500/30 bg-slate-900 px-4 py-3 text-white outline-none focus:border-pink-400"
            >
        </div>

        <div class="overflow-hidden rounded-2xl border border-blue-500/20 bg-[#0B1224] shadow-lg">
            <table class="w-full text-left">
                <thead class="bg-blue-950 text-blue-300">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Ukuran</th>
                        <th class="px-6 py-4">Harga Sewa</th>
                        <th class="px-6 py-4">Stok</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>

                <tbody id="costumeList">
                     @forelse($costumes as $index => $costume)
                     <tr class="{{ $index % 2 == 0 ? 'bg-[#0F172A]' : 'bg-[#13203F]' }} hover:bg-blue-900/40 transition border-b border-slate-700">
                            <td class="px-6 py-4">
                                {{ $costumes->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4 font-semibold">
                                {{ $costume->nama_kostum}}
                            </td>

                            <td class="px-6 py-4">
                                {{ $costume->kategori }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $costume->ukuran }}
                            </td>

                            <td class="px-6 py-4">
                                Rp {{ number_format($costume->harga_sewa, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $costume->stok }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex gap-2">

                                    <a href="{{ route('costumes.edit', $costume->id) }}"
                                       class="rounded-lg bg-yellow-500 px-3 py-2 text-sm font-semibold text-slate-950 hover:bg-yellow-400">
                                        Edit
                                    </a>

                                    <form action="{{ route('costumes.destroy', $costume->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin mau hapus costume ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-500">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-slate-400">
                                Belum ada data costume.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6" id="paginationLinks">
            {{ $costumes->links() }}
        </div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const costumeList = document.getElementById('costumeList');
    const paginationLinks = document.getElementById('paginationLinks');

    searchInput.addEventListener('keyup', function () {
        const keyword = searchInput.value;

        fetch(`{{ route('costumes.live-search') }}?keyword=${encodeURIComponent(keyword)}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(costumes => {
            costumeList.innerHTML = '';

            if (paginationLinks) {
                paginationLinks.style.display = keyword ? 'none' : 'block';
            }

            if (costumes.length === 0) {
                costumeList.innerHTML = `
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-slate-400">
                            Data costume tidak ditemukan.
                        </td>
                    </tr>
                `;
                return;
            }

            costumes.forEach((costume, index) => {
                costumeList.innerHTML += `
                    <tr class="hover:bg-white/5">
                        <td class="px-6 py-4">${index + 1}</td>
                        <td class="px-6 py-4 font-semibold">${costume.nama_kostum}</td>
                        <td class="px-6 py-4">${costume.kategori}</td>
                        <td class="px-6 py-4">${costume.ukuran}</td>
                        <td class="px-6 py-4">Rp ${Number(costume.harga_sewa).toLocaleString('id-ID')}</td>
                        <td class="px-6 py-4">${costume.stok}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="/costumes/${costume.id}"
                                   class="rounded-lg bg-cyan-500 px-3 py-2 text-sm font-semibold text-slate-950 hover:bg-cyan-300">
                                    Detail
                                </a>

                                <a href="/costumes/${costume.id}/edit"
                                   class="rounded-lg bg-yellow-500 px-3 py-2 text-sm font-semibold text-slate-950 hover:bg-yellow-400">
                                    Edit
                                </a>

                                <span class="rounded-lg bg-slate-700 px-3 py-2 text-sm text-slate-300">
                                    Hapus reload
                                </span>
                            </div>
                        </td>
                    </tr>
                `;
            });
        })
        .catch(error => {
            console.error(error);
        });
    });
});
</script>
@endsection
