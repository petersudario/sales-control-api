<?php

namespace Database\Seeders;

use App\Models\Diretoria;
use App\Models\Unidade;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Edson A. do Nascimento',
            'email' => 'pele@magazineaziul.com.br',
            'password' => Hash::make('123mudar'),
            'cargo' => 'Diretor Geral',
        ]);

        $diretores = [
            [
                'name' => 'Vagner Mancini',
                'email' => 'vagner.mancini@magazineaziul.com.br'
            ],

            [
                'name' => 'Rogerio Ceni',
                'email' => 'rogerio.ceni@magazineaziul.com.br',
            ],

            [
                'name' => 'Abel Ferreira',
                'email' => 'abel.ferreira@magazineaziul.com.br',
            ],

        ];

        $gerentes = [
            [
                'name' => 'Ronaldinho Gaucho',
                'email' => 'ronaldinho.gaucho@magazineaziul.com.br',
            ],
            [
                'name' => 'Roberto Firmino',
                'email' => 'roberto.firmino@magazineaziul.com.br',
            ],
            [
                'name' => 'Alex de Souza',
                'email' => 'alex.de.souza@magazineaziul.com.br',
            ],
            [
                'name' => 'Françoaldo Souza',
                'email' => 'françoaldo.souza@magazineaziul.com.br',
            ],
            [
                'name' => 'Romário Faria',
                'email' => 'romário.faria@magazineaziul.com.br',
            ],
            [
                'name' => 'Ricardo Goulart',
                'email' => 'ricardo.goulart@magazineaziul.com.br',
            ],
            [
                'name' => 'Dejan Petkovic',
                'email' => 'dejan.petkovic@magazineaziul.com.br',
            ],
            [
                'name' => 'Deyverson Acosta',
                'email' => 'deyverson.acosta@magazineaziul.com.br',
            ],
            [
                'name' => 'Harlei Silva',
                'email' => 'harlei.silva@magazineaziul.com.br',
            ],
            [
                'name' => 'Walter Henrique',
                'email' => 'walter.henrique@magazineaziul.com.br',
            ],
        ];



        foreach ($gerentes as $gerente) {
            User::create([
                'name' => $gerente['name'],
                'email' => $gerente['email'],
                'password' => Hash::make('123mudar'),
                'cargo' => 'Gerente',
            ]);
        }

        foreach ($diretores as $diretor) {
            User::create([
                'name' => $diretor['name'],
                'email' => $diretor['email'],
                'password' => Hash::make('123mudar'),
                'cargo' => 'Diretor',
            ]);
        }



        Diretoria::create([
            'diretoria' => 'Sul',
            'diretor_id' => User::where('email', 'vagner.mancini@magazineaziul.com.br')->first()->id,
        ]);

        Diretoria::create([
            'diretoria' => 'Sudeste',
            'diretor_id' => User::where('email', 'abel.ferreira@magazineaziul.com.br')->first()->id,
        ]);

        Diretoria::create([
            'diretoria' => 'Centro-Oeste',
            'diretor_id' => User::where('email', 'rogerio.ceni@magazineaziul.com.br')->first()->id,
        ]);


        $unidades = [
            [
                'unidade' => 'Porto Alegre',
                'latitude' => -30.048750057541955,
                'longitude' => -51.228587422990806,
                'gerente_id' => User::where('email', 'ronaldinho.gaucho@magazineaziul.com.br')->first()->id,
                'diretoria_id' => Diretoria::where('diretoria', 'Sul')->first()->id,
            ],
            [
                'unidade' => 'Florianopolis',
                'latitude' => -27.55393525017396,
                'longitude' => -48.49841515885026,
                'gerente_id' => User::where('email', 'roberto.firmino@magazineaziul.com.br')->first()->id,
                'diretoria_id' => Diretoria::where('diretoria', 'Sul')->first()->id,
            ],
            [
                'unidade' => 'Curitiba',
                'latitude' => -25.473704465731746,
                'longitude' => -49.24787198992874,
                'gerente_id' => User::where('email', 'alex.de.souza@magazineaziul.com.br')->first()->id,
                'diretoria_id' => Diretoria::where('diretoria', 'Sul')->first()->id,
            ],
            [
                'unidade' => 'Sao Paulo',
                'latitude' => -23.544259437612844,
                'longitude' => -46.64370714029131,
                'gerente_id' => User::where('email', 'françoaldo.souza@magazineaziul.com.br')->first()->id,
                'diretoria_id' => Diretoria::where('diretoria', 'Sudeste')->first()->id,
            ],
            [
                'unidade' => 'Rio de Janeiro',
                'latitude' => -22.923447510604802,
                'longitude' => -43.23208495438858,
                'gerente_id' => User::where('email', 'romário.faria@magazineaziul.com.br')->first()->id,
                'diretoria_id' => Diretoria::where('diretoria', 'Sudeste')->first()->id,
            ],
            [
                'unidade' => 'Belo Horizonte',
                'latitude' => -19.917854829716372,
                'longitude' => -43.94089385954766,
                'gerente_id' => User::where('email', 'ricardo.goulart@magazineaziul.com.br')->first()->id,
                'diretoria_id' => Diretoria::where('diretoria', 'Sudeste')->first()->id,
            ],
            [
                'unidade' => 'Vitória',
                'latitude' => -20.340992420772206,
                'longitude' => -40.38332271475097,
                'gerente_id' => User::where('email', 'dejan.petkovic@magazineaziul.com.br')->first()->id,
                'diretoria_id' => Diretoria::where('diretoria', 'Sudeste')->first()->id,
            ],
            [
                'unidade' => 'Campo Grande',
                'latitude' => -20.462652006300377,
                'longitude' => -54.615658937666645,
                'gerente_id' => User::where('email', 'deyverson.acosta@magazineaziul.com.br')->first()->id,
                'diretoria_id' => Diretoria::where('diretoria', 'Centro-Oeste')->first()->id,
            ],
            [
                'unidade' => 'Goiania',
                'latitude' => -16.673126240814387,
                'longitude' => -49.25248826354209,
                'gerente_id' => User::where('email', 'harlei.silva@magazineaziul.com.br')->first()->id,
                'diretoria_id' => Diretoria::where('diretoria', 'Centro-Oeste')->first()->id,
            ],
            [
                'unidade' => 'Cuiaba',
                'latitude' => -15.601754458320842,
                'longitude' => -56.09832706558089,
                'gerente_id' => User::where('email', 'walter.henrique@magazineaziul.com.br')->first()->id,
                'diretoria_id' => Diretoria::where('diretoria', 'Centro-Oeste')->first()->id,
            ],
        ];

        foreach ($unidades as $unidade) {
            Unidade::create([
                'unidade' => $unidade['unidade'],
                'latitude' => $unidade['latitude'],
                'longitude' => $unidade['longitude'],
                'gerente_id' => $unidade['gerente_id'],
                'diretoria_id' => $unidade['diretoria_id'],
            ]);
        }

        User::where('email', 'vagner.mancini@magazineaziul.com.br')->update(['diretoria_id' => Diretoria::where('diretoria', 'Sul')->first()->id]);
        User::where('email', 'abel.ferreira@magazineaziul.com.br')->update(['diretoria_id' => Diretoria::where('diretoria', 'Sudeste')->first()->id]);
        User::where('email', 'rogerio.ceni@magazineaziul.com.br')->update(['diretoria_id' => Diretoria::where('diretoria', 'Centro-Oeste')->first()->id]);

        $gerentesQuery = User::where('cargo', 'Gerente');

        foreach ($gerentesQuery->get() as $gerente) {
            $gerente->update(['unidade_id' => Unidade::where('gerente_id', $gerente->id)->first()->id, 'diretoria_id' => Unidade::where('gerente_id', $gerente->id)->first()->diretoria_id]);
        }
        

        $vendedores = [
            ['name' => 'Afonso Afancar', 'email' => 'afonso.afancar@magazineaziul.com.br', 'unidade' => 'Belo Horizonte'],
            ['name' => 'Alceu Andreoli', 'email' => 'alceu.andreoli@magazineaziul.com.br', 'unidade' => 'Belo Horizonte'],
            ['name' => 'Amalia Zago', 'email' => 'amalia.zago@magazineaziul.com.br', 'unidade' => 'Belo Horizonte'],
            ['name' => 'Carlos Eduardo', 'email' => 'carlos.eduardo@magazineaziul.com.br', 'unidade' => 'Belo Horizonte'],
            ['name' => 'Luiz Felipe', 'email' => 'luiz.felipe@magazineaziul.com.br', 'unidade' => 'Belo Horizonte'],
            ['name' => 'Breno', 'email' => 'breno@magazineaziul.com.br', 'unidade' => 'Campo Grande'],
            ['name' => 'Emanuel', 'email' => 'emanuel@magazineaziul.com.br', 'unidade' => 'Campo Grande'],
            ['name' => 'Ryan', 'email' => 'ryan@magazineaziul.com.br', 'unidade' => 'Campo Grande'],
            ['name' => 'Vitor Hugo', 'email' => 'vitor.hugo@magazineaziul.com.br', 'unidade' => 'Campo Grande'],
            ['name' => 'Yuri', 'email' => 'yuri@magazineaziul.com.br', 'unidade' => 'Campo Grande'],
            ['name' => 'Benjamin', 'email' => 'benjamin@magazineaziul.com.br', 'unidade' => 'Cuiaba'],
            ['name' => 'Erick', 'email' => 'erick@magazineaziul.com.br', 'unidade' => 'Cuiaba'],
            ['name' => 'Enzo Gabriel', 'email' => 'enzo.gabriel@magazineaziul.com.br', 'unidade' => 'Cuiaba'],
            ['name' => 'Fernando', 'email' => 'fernando@magazineaziul.com.br', 'unidade' => 'Cuiaba'],
            ['name' => 'Joaquim', 'email' => 'joaquim@magazineaziul.com.br', 'unidade' => 'Cuiaba'],
            ['name' => 'André', 'email' => 'andré@magazineaziul.com.br', 'unidade' => 'Curitiba'],
            ['name' => 'Raul', 'email' => 'raul@magazineaziul.com.br', 'unidade' => 'Curitiba'],
            ['name' => 'Marcelo', 'email' => 'marcelo@magazineaziul.com.br', 'unidade' => 'Curitiba'],
            ['name' => 'Julio César', 'email' => 'julio.césar@magazineaziul.com.br', 'unidade' => 'Curitiba'],
            ['name' => 'Cauê', 'email' => 'cauê@magazineaziul.com.br', 'unidade' => 'Curitiba'],
            ['name' => 'Benício', 'email' => 'benício@magazineaziul.com.br', 'unidade' => 'Florianopolis'],
            ['name' => 'Vitor Gabriel', 'email' => 'vitor.gabriel@magazineaziul.com.br', 'unidade' => 'Florianopolis'],
            ['name' => 'Augusto', 'email' => 'augusto@magazineaziul.com.br', 'unidade' => 'Florianopolis'],
            ['name' => 'Pedro Lucas', 'email' => 'pedro.lucas@magazineaziul.com.br', 'unidade' => 'Florianopolis'],
            ['name' => 'Luiz Gustavo', 'email' => 'luiz.gustavo@magazineaziul.com.br', 'unidade' => 'Florianopolis'],
            ['name' => 'Giovanni', 'email' => 'giovanni@magazineaziul.com.br', 'unidade' => 'Goiania'],
            ['name' => 'Renato', 'email' => 'renato@magazineaziul.com.br', 'unidade' => 'Goiania'],
            ['name' => 'Diego', 'email' => 'diego@magazineaziul.com.br', 'unidade' => 'Goiania'],
            ['name' => 'João Paulo', 'email' => 'joão.paulo@magazineaziul.com.br', 'unidade' => 'Goiania'],
            ['name' => 'Renan', 'email' => 'renan@magazineaziul.com.br', 'unidade' => 'Goiania'],
            ['name' => 'Luiz Fernando', 'email' => 'luiz.fernando@magazineaziul.com.br', 'unidade' => 'Porto Alegre'],
            ['name' => 'Anthony', 'email' => 'anthony@magazineaziul.com.br', 'unidade' => 'Porto Alegre'],
            ['name' => 'Lucas Gabriel', 'email' => 'lucas.gabriel@magazineaziul.com.br', 'unidade' => 'Porto Alegre'],
            ['name' => 'Thales', 'email' => 'thales@magazineaziul.com.br', 'unidade' => 'Porto Alegre'],
            ['name' => 'Luiz Miguel', 'email' => 'luiz.miguel@magazineaziul.com.br', 'unidade' => 'Porto Alegre'],
            ['name' => 'Henry', 'email' => 'henry@magazineaziul.com.br', 'unidade' => 'Rio de Janeiro'],
            ['name' => 'Marcos Vinicius', 'email' => 'marcos.vinicius@magazineaziul.com.br', 'unidade' => 'Rio de Janeiro'],
            ['name' => 'Kevin', 'email' => 'kevin@magazineaziul.com.br', 'unidade' => 'Rio de Janeiro'],
            ['name' => 'Levi', 'email' => 'levi@magazineaziul.com.br', 'unidade' => 'Rio de Janeiro'],
            ['name' => 'Enrico', 'email' => 'enrico@magazineaziul.com.br', 'unidade' => 'Rio de Janeiro'],
            ['name' => 'João Lucas', 'email' => 'joão.lucas@magazineaziul.com.br', 'unidade' => 'Sao Paulo'],
            ['name' => 'Hugo', 'email' => 'hugo@magazineaziul.com.br', 'unidade' => 'Sao Paulo'],
            ['name' => 'Luiz Guilherme', 'email' => 'luiz.guilherme@magazineaziul.com.br', 'unidade' => 'Sao Paulo'],
            ['name' => 'Matheus Henrique', 'email' => 'matheus.henrique@magazineaziul.com.br', 'unidade' => 'Sao Paulo'],
            ['name' => 'Miguel', 'email' => 'miguel@magazineaziul.com.br', 'unidade' => 'Sao Paulo'],
            ['name' => 'Davi', 'email' => 'davi@magazineaziul.com.br', 'unidade' => 'Vitória'],
            ['name' => 'Gabriel', 'email' => 'gabriel@magazineaziul.com.br', 'unidade' => 'Vitória'],
            ['name' => 'Arthur', 'email' => 'arthur@magazineaziul.com.br', 'unidade' => 'Vitória'],
            ['name' => 'Lucas', 'email' => 'lucas@magazineaziul.com.br', 'unidade' => 'Vitória'],
            ['name' => 'Matheus', 'email' => 'matheus@magazineaziul.com.br', 'unidade' => 'Vitória'],
        ];

        foreach ($vendedores as $vendedor) {
            User::create([
                'name' => $vendedor['name'],
                'email' => $vendedor['email'],
                'password' => Hash::make('123mudar'),
                'cargo' => 'Vendedor',
                'unidade_id' => Unidade::where('unidade', $vendedor['unidade'])->first()->id,
                'diretoria_id' => Unidade::where('unidade', $vendedor['unidade'])->first()->diretoria_id,
                'gerente_id' => Unidade::where('unidade', $vendedor['unidade'])->first()->gerente_id,
            ]);
        }

    }

}
