<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run(): void
    {
        $products = [
            [
                'name' => 'Camiseta básica',
                'price' => 19.99,
                'stock' => 50,
            ],
            [
                'name' => 'Calça jeans',
                'price' => 39.99,
                'stock' => 30,
            ],
            [
                'name' => 'Tênis esportivo',
                'price' => 59.99,
                'stock' => 20,
            ],
            [
                'name' => 'Mochila escolar',
                'price' => 29.99,
                'stock' => 40,
            ],
            [
                'name' => 'Relógio de pulso',
                'price' => 79.99,
                'stock' => 15,
            ],
            [
                'name' => 'Fone de ouvido Bluetooth',
                'price' => 49.99,
                'stock' => 25,
            ],
            [
                'name' => 'Monitor LCD 24 polegadas',
                'price' => 199.99,
                'stock' => 10,
            ],
            [
                'name' => 'Teclado mecânico',
                'price' => 89.99,
                'stock' => 20,
            ],
            [
                'name' => 'Mouse sem fio',
                'price' => 24.99,
                'stock' => 30,
            ],
            [
                'name' => 'Cadeira de escritório',
                'price' => 119.99,
                'stock' => 5,
            ],
            [
                'name' => 'Notebook 15 polegadas',
                'price' => 799.99,
                'stock' => 10,
            ],
            [
                'name' => 'Tablet Android',
                'price' => 129.99,
                'stock' => 15,
            ],
            [
                'name' => 'Impressora a jato de tinta',
                'price' => 59.99,
                'stock' => 12,
            ],
            [
                'name' => 'Carregador portátil',
                'price' => 19.99,
                'stock' => 40,
            ],
            [
                'name' => 'Fogão elétrico',
                'price' => 199.99,
                'stock' => 8,
            ],
            [
                'name' => 'Liquidificador',
                'price' => 39.99,
                'stock' => 20,
            ],
            [
                'name' => 'Ventilador de mesa',
                'price' => 29.99,
                'stock' => 25,
            ],
            [
                'name' => 'Câmera digital',
                'price' => 149.99,
                'stock' => 10,
            ],
            [
                'name' => 'Chapéu de sol',
                'price' => 9.99,
                'stock' => 50,
            ],
            [
                'name' => 'Mala de viagem',
                'price' => 49.99,
                'stock' => 15,
            ],
            [
                'name' => 'Churrasqueira a carvão',
                'price' => 79.99,
                'stock' => 7,
            ],
            [
                'name' => 'Bicicleta de montanha',
                'price' => 299.99,
                'stock' => 3,
            ],
            [
                'name' => 'Cadeira de praia',
                'price' => 14.99,
                'stock' => 35,
            ],
            [
                'name' => 'Laptop gamer',
                'price' => 1499.99,
                'stock' => 5,
            ],
            [
                'name' => 'Caixa de som Bluetooth',
                'price' => 34.99,
                'stock' => 18,
            ],
            [
                'name' => 'Panela de pressão elétrica',
                'price' => 69.99,
                'stock' => 10,
            ],
            [
                'name' => 'Cama de solteiro',
                'price' => 119.99,
                'stock' => 6,
            ],
            [
                'name' => 'Óculos de sol',
                'price' => 29.99,
                'stock' => 40,
            ],
            [
                'name' => 'Máquina de café expresso',
                'price' => 89.99,
                'stock' => 12,
            ],
            [
                'name' => 'Tábua de passar roupa',
                'price' => 19.99,
                'stock' => 25,
            ],
        ];

        foreach ($products as $productsData) {
            Product::create([
                'name' => $productsData['name'],
                'price' => $productsData['price'],
                'stock' => $productsData['stock']
            ]);
        }
    }
}
