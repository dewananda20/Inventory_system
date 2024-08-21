<?php
 
namespace App\Repositories;
use App\Models\Items;
use Illuminate\Support\Facades\Storage;

class ItemsRepository
{
    protected $items;

    public function __construct(Items $items)
    {
        $this->items = $items;
    }

    public function getAll()
    {
        $items = Items::with(['user:id,username', 'category:id,name'])
                ->orderBy('created_at', 'desc')
                ->get();

        return $items;
    }

    public function findById($id){
        $items = Items::where('id', $id)->firstOrFail();

        return $items;
    }

    public function create(array $data, $userId){
         // Proses upload gambar
         if (isset($data['image'])) {
            $image = $data['image'];
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');

            // Tambahkan path gambar ke array data
            $data['image'] = 'storage/' . $imagePath;
        }

        // Tambahkan user_id ke data
        $data['users_id'] = $userId;

        // Simpan data ke database
        return Items::create($data);
    }

    public function update(array $data, $id)
    {
        $item = $this->findById($id);
        
        if ($item) {
            if (isset($data['image'])) {
                // Hapus gambar lama jika ada
                if ($item->image) {
                    $oldImagePath = str_replace('storage/', '', $item->image);
                    if (Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }

                // Upload dan simpan path gambar baru
                $image = $data['image'];
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $imagePath = $image->storeAs('images', $imageName, 'public');

                // Tambahkan path gambar baru ke array data
                $data['image'] = 'storage/' . $imagePath;
            }

            // Update status jika stok 0
            if (isset($data['stock']) && $data['stock'] == 0) {
                $data['status'] = 'unavailable';
            } else {
                $data['status'] = 'available';
            }

            // Lakukan update item
            $item->update($data);
            return $item;
        }
        
        return null;
    }

    public function delete($id)
    {
        $item = Items::where('id', $id)->firstOrFail();

        if ($item->image) {
            // Ubah path sesuai dengan sistem operasi Windows
            $imagePath = str_replace('storage\\', '', $item->image);
            
            // Memastikan bahwa path bekerja di semua OS
            $imagePath = str_replace('/', '\\', $imagePath);

            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $item->delete();
    }

}


?>