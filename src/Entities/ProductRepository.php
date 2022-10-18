<?php

namespace App\Entities;

use Doctrine\ORM\EntityRepository;
use App\Entities\Product;

class ProductRepository extends EntityRepository
{
    public function fetchAll(): array
    {
        $products = $this->findAll();

        foreach ($products as $key => $value) {
            $products[$key] = $value->toArray();
        }

        return $products;
    }

    public function getById(Int $id): ?Product
    {
        /**
         * Product domain
         * 
         * @var \App\Entities\Product
         */
        $product = $this->findOneBy(['id' => $id]);

        return $product;
    }

    public function getBySlug(String $slug): ?Product
    {
        /**
         * Product domain
         * 
         * @var \App\Entities\Product
         */
        $product = $this->findOneBy(['slug' => $slug]);

        return $product;
    }

    public function getByQuery(array $query): array
    {
        /**
         * Product domain
         * 
         * @var \App\Entities\Product
         */
        $products = $this->findBy($query);

        foreach ($products as $key => $value) {
            $products[$key] = $value->toArray();
        }

        return $products;
    }

    public function create(array $data)
    {
        /**
         * Product domain
         * 
         * @var \App\Entities\Product
         */
        $product = new Product();

        $product->setName($data['name']);
        $product->setSlug($data['slug']);
        $product->setDescription($data['description']);
        $product->setPrice($data['price']);
        $product->setStock($data['stock']);
        $product->setKeywords($data['keywords']);

        $this->_em->persist($product);
    }

    public function update(Int $id, array $data)
    {
        /**
         * Product domain
         * 
         * @var \App\Entities\Product
         */
        $product = $this->findOneBy(['id' => $id]);

        $product->setName($data['name']);
        $product->setSlug($data['slug']);
        $product->setDescription($data['description']);
        $product->setPrice($data['price']);
        $product->setStock($data['stock']);
        $product->setKeywords($data['keywords']);

        $this->_em->persist($product);

        $this->_em->flush();
    }

    public function destroy($id)
    {
        /**
         * Product domain
         * 
         * @var \App\Entities\Product
         */
        $product = $this->findOneBy(['id' => $id]);

        $result = $this->_em->remove($product);

        $this->_em->flush();
    }
}
