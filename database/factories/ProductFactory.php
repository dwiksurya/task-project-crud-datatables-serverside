<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker = \Faker\Factory::create();
        $this->faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($this->faker));

        return [
            'name' => $this->faker->productName(),
            'merchant_id' => Merchant::all()->random()->id,
            'price' => $this->faker->randomNumber(5),
            'status' => $this->faker->boolean($chanceOfGettingTrue = 90)
        ];
    }
}
