<?php

namespace Tests\Feature;

use App\Models\Alumno;
use App\Models\Modulo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_ver_alumnos_returns_successful_response(): void
    {
        $alumno = Alumno::create([
            'nombre' => 'Juan',
            'apellidos' => 'Pérez',
            'fnac' => '2000-01-01',
            'genero' => 'masculino',
            'nacceso' => 8.5,
        ]);

        $response = $this->get(route('alumno.index'));
        $response->assertStatus(200);
        $response->assertSee('Juan');
        $response->assertSee(route('alumno.matricular', $alumno));

        $showResponse = $this->get(route('alumno.show', $alumno));
        $showResponse->assertStatus(200);
        $showResponse->assertSee('Juan Pérez');
        $showResponse->assertSee(route('alumno.matricular', $alumno));

        $matricularResponse = $this->get(route('alumno.matricular', $alumno));
        $matricularResponse->assertStatus(200);
        $matricularResponse->assertSee('Matricular');
    }

    public function test_ver_modulos_returns_successful_response(): void
    {
        $modulo = Modulo::create([
            'nombre' => 'Desarrollo Web Servidor',
            'abreviatura' => 'DWES',
            'horas' => 8,
            'creditos' => 10,
        ]);

        $response = $this->get(route('modulo.index'));
        $response->assertStatus(200);
        $response->assertSee('Desarrollo Web Servidor');

        $showResponse = $this->get(route('modulo.show', $modulo));
        $showResponse->assertStatus(200);
        $showResponse->assertSee('Desarrollo Web Servidor DWES');
    }

    public function test_gestion_page_returns_successful_response(): void
    {
        $response = $this->get(route('gestion'));
        $response->assertStatus(200);
        $response->assertSee(route('alumno.index'));
        $response->assertSee(route('modulo.index'));
    }
}
