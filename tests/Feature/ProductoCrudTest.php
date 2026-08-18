<?php

namespace Tests\Feature;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_crud_flow_works(): void
    {
        $this->get(route('productos.index'))
            ->assertOk()
            ->assertSee('Tu catálogo está vacío');

        $this->post(route('productos.store'), [
            'nombre' => 'Café de altura',
            'descripcion' => 'Grano tostado medio.',
            'precio' => '48.50',
            'stock' => 12,
        ])->assertRedirect(route('productos.index'));

        $producto = Producto::query()->firstOrFail();

        $this->assertDatabaseHas('productos', [
            'id' => $producto->id,
            'nombre' => 'Café de altura',
            'stock' => 12,
        ]);

        $this->get(route('productos.show', $producto))
            ->assertOk()
            ->assertSee('Café de altura');

        $this->put(route('productos.update', $producto), [
            'nombre' => 'Café de altura premium',
            'descripcion' => 'Grano tostado oscuro.',
            'precio' => '52.00',
            'stock' => 8,
        ])->assertRedirect(route('productos.index'));

        $this->assertDatabaseHas('productos', [
            'id' => $producto->id,
            'nombre' => 'Café de altura premium',
            'precio' => '52.00',
            'stock' => 8,
        ]);

        $this->delete(route('productos.destroy', $producto))
            ->assertRedirect(route('productos.index'));

        $this->assertDatabaseMissing('productos', ['id' => $producto->id]);
    }
}
