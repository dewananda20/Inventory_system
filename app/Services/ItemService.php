<?php 
namespace App\Services;

use App\Repositories\ItemsRepository;

class ItemService
{
    protected $itemsRepository;
    public function __construct(ItemsRepository $itemsRepository)
    {
        $this->itemsRepository = $itemsRepository;
    }

    public function getAll()
    {
        return $this->itemsRepository->getAll();
    }

    public function findById($id)
    {
        return $this->itemsRepository->findById($id);
    }

    public function create($data, $userId){
        return $this->itemsRepository->create($data, $userId);
    }

    // public function updateItem(array $data, $id)
    // {
    //     return $this->itemsRepository->update($data, $id);
    // }

    public function updateItem($id, array $data)
    {
        return $this->itemsRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->itemsRepository->delete($id);
    }
}   
?>