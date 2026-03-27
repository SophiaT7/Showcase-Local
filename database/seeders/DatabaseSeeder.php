<?php

namespace Database\Seeders;

use App\Models\Avaliacao;
use App\Models\Categoria;
use App\Models\GaleriaFoto;
use App\Models\Horario;
use App\Models\Servico;
use App\Models\User;
use App\Models\Vitrine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin ───────────────────────────────────────────
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@vitrine.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // ── Categorias ─────────────────────────────────────
        $categorias = collect([
            ['nome' => 'Alimentação',      'slug' => 'alimentacao',      'icone' => 'utensils'],
            ['nome' => 'Beleza & Estética', 'slug' => 'beleza-estetica', 'icone' => 'scissors'],
            ['nome' => 'Saúde',            'slug' => 'saude',            'icone' => 'heart-pulse'],
            ['nome' => 'Tecnologia',       'slug' => 'tecnologia',       'icone' => 'laptop'],
            ['nome' => 'Educação',         'slug' => 'educacao',         'icone' => 'graduation-cap'],
            ['nome' => 'Serviços Gerais',  'slug' => 'servicos-gerais',  'icone' => 'wrench'],
            ['nome' => 'Moda & Vestuário', 'slug' => 'moda-vestuario',   'icone' => 'shirt'],
            ['nome' => 'Pets',             'slug' => 'pets',              'icone' => 'paw-print'],
        ])->map(fn ($c) => Categoria::create($c));

        // ── Empreendedores e Vitrines ───────────────────────
        $vitrinesData = [
            [
                'user' => ['name' => 'Maria Silva', 'email' => 'maria@teste.com'],
                'vitrine' => [
                    'nome' => 'Sabor da Maria', 'descricao' => 'Comida caseira feita com amor e ingredientes frescos.',
                    'whatsapp' => '11999990001', 'cidade' => 'São Paulo', 'bairro' => 'Vila Mariana', 'estado' => 'SP',
                    'cor_primaria' => '#e74c3c', 'categoria' => 'alimentacao',
                    'tags' => ['marmita', 'comida caseira', 'bolo', 'salgados', 'almoço', 'delivery', 'comida fit'],
                ],
                'servicos' => [
                    ['nome' => 'Marmita Fit', 'descricao' => 'Marmita saudável com proteína, carboidrato e salada.', 'preco' => 25.00, 'ordem' => 1],
                    ['nome' => 'Bolo Caseiro', 'descricao' => 'Bolo de chocolate, cenoura ou milho.', 'preco' => 35.00, 'ordem' => 2],
                    ['nome' => 'Salgados (cento)', 'descricao' => 'Coxinha, bolinha de queijo, risole.', 'preco' => 80.00, 'ordem' => 3],
                ],
            ],
            [
                'user' => ['name' => 'João Barbosa', 'email' => 'joao@teste.com'],
                'vitrine' => [
                    'nome' => 'Barbearia do João', 'descricao' => 'Cortes modernos e tradicionais no coração de BH.',
                    'whatsapp' => '31999990002', 'cidade' => 'Belo Horizonte', 'bairro' => 'Savassi', 'estado' => 'MG',
                    'cor_primaria' => '#2c3e50', 'categoria' => 'beleza-estetica',
                    'tags' => ['cabelo', 'barba', 'corte masculino', 'barbearia', 'degradê', 'navalha', 'cabeleleiro'],
                ],
                'servicos' => [
                    ['nome' => 'Corte Masculino', 'descricao' => 'Corte social ou degradê.', 'preco' => 40.00, 'ordem' => 1],
                    ['nome' => 'Barba', 'descricao' => 'Barba com toalha quente e navalha.', 'preco' => 25.00, 'ordem' => 2],
                    ['nome' => 'Corte + Barba', 'descricao' => 'Combo completo.', 'preco' => 55.00, 'ordem' => 3],
                ],
            ],
            [
                'user' => ['name' => 'Ana Costa', 'email' => 'ana@teste.com'],
                'vitrine' => [
                    'nome' => 'Tech Ana', 'descricao' => 'Assistência técnica para computadores e celulares.',
                    'whatsapp' => '21999990003', 'cidade' => 'Rio de Janeiro', 'bairro' => 'Tijuca', 'estado' => 'RJ',
                    'cor_primaria' => '#3498db', 'categoria' => 'tecnologia',
                    'tags' => ['computador', 'celular', 'notebook', 'formatação', 'tela', 'conserto', 'assistência técnica', 'informática'],
                ],
                'servicos' => [
                    ['nome' => 'Formatação', 'descricao' => 'Formatação com backup e instalação de programas.', 'preco' => 100.00, 'ordem' => 1],
                    ['nome' => 'Troca de Tela', 'descricao' => 'Troca de tela para smartphones.', 'preco' => 150.00, 'ordem' => 2],
                    ['nome' => 'Limpeza Interna', 'descricao' => 'Limpeza e troca de pasta térmica.', 'preco' => 80.00, 'ordem' => 3],
                ],
            ],
        ];

        $dias = [
            ['dia_semana' => 0, 'fechado' => true],
            ['dia_semana' => 1, 'abertura' => '08:00', 'fechamento' => '18:00'],
            ['dia_semana' => 2, 'abertura' => '08:00', 'fechamento' => '18:00'],
            ['dia_semana' => 3, 'abertura' => '08:00', 'fechamento' => '18:00'],
            ['dia_semana' => 4, 'abertura' => '08:00', 'fechamento' => '18:00'],
            ['dia_semana' => 5, 'abertura' => '08:00', 'fechamento' => '18:00'],
            ['dia_semana' => 6, 'abertura' => '09:00', 'fechamento' => '13:00'],
        ];

        $nomes = ['Carlos', 'Fernanda', 'Lucas', 'Patrícia', 'Rafael', 'Juliana', 'Pedro', 'Amanda'];

        foreach ($vitrinesData as $data) {
            $user = User::create([
                'name'     => $data['user']['name'],
                'email'    => $data['user']['email'],
                'password' => Hash::make('password'),
                'role'     => 'empreendedor',
            ]);

            $cat = $categorias->firstWhere('slug', $data['vitrine']['categoria']);

            $vitrine = Vitrine::create([
                'user_id'      => $user->id,
                'categoria_id' => $cat->id,
                'nome'         => $data['vitrine']['nome'],
                'slug'         => Str::slug($data['vitrine']['nome']) . '-' . Str::random(5),
                'descricao'    => $data['vitrine']['descricao'],
                'whatsapp'     => $data['vitrine']['whatsapp'],
                'cidade'       => $data['vitrine']['cidade'],
                'bairro'       => $data['vitrine']['bairro'],
                'estado'       => $data['vitrine']['estado'],
                'cor_primaria' => $data['vitrine']['cor_primaria'],
                'tags'         => $data['vitrine']['tags'] ?? null,
                'status'       => 'active',
            ]);

            foreach ($data['servicos'] as $s) {
                $vitrine->servicos()->create(array_merge($s, ['ativo' => true]));
            }

            foreach ($dias as $d) {
                $vitrine->horarios()->create(array_merge($d, ['fechado' => $d['fechado'] ?? false]));
            }

            // Avaliações
            for ($i = 0; $i < 5; $i++) {
                $vitrine->avaliacoes()->create([
                    'nome_visitante' => $nomes[array_rand($nomes)],
                    'nota'           => rand(3, 5),
                    'comentario'     => 'Ótimo atendimento! Recomendo muito.',
                    'aprovado'       => $i < 4,
                ]);
            }
        }
    }
}
