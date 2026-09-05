<x-app-layout>
    <div style="padding: 40px 0;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 24px;">Daftar Produk Kami</h2>

            <!-- Tombol Tambah Produk -->
            <div style="margin-bottom: 24px;">
                <a href="{{ route('admin.products.create') }}" style="background-color: #2563eb; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block;">
                    + Tambah Produk
                </a>
            </div>

            <!-- Notifikasi Pesan Sukses -->
            @if(session('success'))
                <div style="background-color: #d1fae5; color: #065f46; padding: 15px; border-radius: 6px; margin-bottom: 20px; font-weight: 500;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Grid Daftar Produk -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                @forelse($products as $product)
                    <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #e5e7eb; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 180px; object-fit: cover; border-radius: 6px; margin-bottom: 12px;">
                        @else
                            <div style="width: 100%; height: 180px; background: #e5e7eb; display: flex; align-items: center; justify-content: center; border-radius: 6px; color: #6b7280; margin-bottom: 12px;">
                                Tidak Ada Gambar
                            </div>
                        @endif

                        <h3 style="font-size: 18px; font-weight: bold; color: #1f2937; margin-bottom: 8px;">{{ $product->name }}</h3>
                        <p style="color: #4b5563; font-size: 14px; margin-bottom: 8px;">{{ $product->description }}</p>
                        <p style="color: #4f46e5; font-weight: bold; font-size: 16px; margin-bottom: 4px;">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <p style="color: #6b7280; font-size: 12px; margin-bottom: 16px;">Stok: {{ $product->stock }}</p>

                       <!-- Tombol Beli via WhatsApp -->
                        <a href="https://wa.me/6282399114997?text=Halo,%20saya%20tertarik%20dengan%20produk%20{{ $product->name }}" 
                        target="_blank" 
                        style="display: block; width: 100%; text-align: center; background-color: #16a34a; color: white; padding: 10px 0; text-decoration: none; border-radius: 6px; font-weight: bold; margin-bottom: 8px;">
                        Beli Sekarang via WhatsApp
                        </a>

                        <!-- Tombol Edit -->
                        <a href="{{ route('admin.products.edit', $product->id) }}" style="display: block; width: 100%; text-align: center; background-color: #eab308; color: white; padding: 10px 0; border-radius: 6px; font-weight: bold; text-decoration: none; margin-bottom: 8px; box-sizing: border-box;">
                            Edit Produk
                        </a>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="display: block; width: 100%; text-align: center; background-color: #b91c1c; color: white; padding: 10px 0; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; box-sizing: border-box;">
                                Hapus Produk
                            </button>
                        </form>
                    </div>
                @empty
                    <p style="grid-column: span 3; text-align: center; color: #6b7280; padding: 20px;">Belum ada produk yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>