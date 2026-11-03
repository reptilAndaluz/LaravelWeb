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

    public function test_matricular_alumno_duplicate_returns_friendly_error(): void
    {
        $alumno = Alumno::create([
            'nombre' => 'Ana',
            'apellidos' => 'Gómez',
            'fnac' => '2001-05-10',
            'genero' => 'femenino',
            'nacceso' => 9.0,
        ]);

        $modulo = Modulo::create([
            'nombre' => 'Diseño Interfaces',
            'abreviatura' => 'DIW',
            'horas' => 6,
            'creditos' => 8,
        ]);

        // Primera matrícula debe ser exitosa
        $firstResponse = $this->post(route('matricula.store'), [
            'alumno_id' => $alumno->id,
            'modulo_id' => $modulo->id,
        ]);
        $firstResponse->assertSessionHas('success');

        // Segunda matrícula duplicada en el mismo curso debe fallar con error descriptivo
        $secondResponse = $this->from(route('alumno.matricular', $alumno))->post(route('matricula.store'), [
            'alumno_id' => $alumno->id,
            'modulo_id' => $modulo->id,
        ]);
        $secondResponse->assertSessionHasErrors(['error']);
        $secondResponse->assertRedirect(route('alumno.matricular', $alumno));

        // En la vista de matricular debe aparecer como ya matriculado
        $viewResponse = $this->get(route('alumno.matricular', $alumno));
        $viewResponse->assertStatus(200);
        $viewResponse->assertSee('(Ya matriculado)');
    }
}
