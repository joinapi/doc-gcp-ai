<?php

return [
    'types' => [
        'CNH' => [
            'name' => 'CNH',
            'label' => 'CNH',
            'docid' => [
                'DOCID' => 'DOCID',
                'terms' => [
                    'CARTEIRA NACIONAL DE HABILITAÇÃO',
                    'CARTEIRA NACIONAL DE HABILITACAO',
                    'SECRETARIA NACIONAL DE TRÂNSITO',
                    'SECRETARIA NACIONAL DE TRANSITO',
                    'DEPARTAMENTO NACIONAL DE TRÂNSITO',
                    'DEPARTAMENTO NACIONAL DE TRANSITO',
                    'DEPARTAMENTO ESTADUAL DE TRÂNSITO',
                    'DEPARTAMENTO ESTADUAL DE TRANSITO',
                ]

            ],
            'relation' => 'documentCNH',
            'fields' => [
                'numero_registro' => 'numero_registro',
                'rg',
                'cpf',
                'filiacao',
                'numero',
                'nome',
                'emitido_em',
                'dt_nascimento',
            ],
            'rules' => [
                'numero_registro' => 'numero_registro|required',
            ],
            'processor' => [
                'id' => '17085d700f352998',
                'class' => 'App\Processors\CNHProcessor',
                'options' => [
                    'path' => 'storage/app/cnh'
                ],
                'fields' => [
                    'NUMERO_REGISTRO' => 'numero_registro',
                    'DOC_IDENTIDADE' => 'rg',
                    'CPF' => 'cpf',
                    'FILIACAO' => 'filiacao',
                    'NUMERO' => 'numero',
                    'NOME_SOBRENOME' => 'nome',
                    'DATA_EMISSAO' => 'emitido_em',
                    'DATA_NASCIMENTO' => 'dt_nascimento',
                ]
            ]
        ],
        'RG' => [
            'name' => 'RG',
            'label' => 'RG',
            'docid' => [
                'DOCID' => 'DOCID',
                'terms' => [
                    'SECRETARIA DE ESTADO DA SEGURANÇA PÚBLICA',
                    'SECRETARIA DE ESTADO DA SEGURANCA PUBLICA',
                    'SECRETARIA DA SEGURANCA PUBLICA',
                    'SECRETARIA DA SEGURANÇA PÚBLICA',
                    'SECRETARIA DA SEGURANÇA PUBLICA',
                    'CARTEIRA DE IDENTIDADE',
                ]

            ],
            'relation' => 'documentRG',
            'fields' => [
                'registro_geral',
                'rg',
                'cpf',
                'filiacao',
                'naturalidade',
                'nome',
                'dt_expedicao',
                'dt_nascimento',
            ],
            'rules' => [
              'cpf' => 'cpf|required',
            ],
            'processor' => [
                'id' => 'c8370c4cde67c091',
                'class' => 'App\Processors\RGProcessor',
                'options' => [
                    'path' => 'storage/app/rg'
                ],
                'fields' => [
                    'REGISTRO_GERAL' => 'registro_geral',
                    'CPF' => 'cpf',
                    'FILIACAO' => 'filiacao',
                    'NATURALIDADE' => 'naturalidade',
                    'DATA_NASCIMENTO' => 'dt_nascimento',
                    'NOME' => 'nome',
                    'DATA_EXPEDICAO' => 'dt_expedicao',
                ]
            ]
        ],
        'TE' => [
            'name' => 'TE',
            'label' => 'TITULAR DE ELEITOR',
            'docid' => [
                'DOCID' => 'DOCID',
                'terms' => [
                    'TÍTULO ELEITORAL',
                    'TITULO ELEITORAL',
                ]
            ],
            'relation' => 'documentTE',
            'fields' => [
                'titulo_eleitor',
                'secao',
                'zona',
                'filiacao',
                'codigo_validacao',
                'nome',
                'dt_emissao',
                'municipio',
                'dt_nascimento',
            ],
            'rules' => [
                'titulo_eleitor' => 'titulo_eleitor|required',
                'zona' => 'zona|required',
                'secao' => 'secao|required',
            ],
            'processor' => [
                'id' => '2820b8d38553684c',
                'class' => 'App\Processors\TEProcessor',
                'options' => [
                    'path' => 'storage/app/te'
                ],
                'fields' => [
                    'NOME_ELEITOR' => 'nome',
                    'DT_NASCIMENTO' => 'dt_nascimento',
                    'MUNICIPIO' => 'municipio',
                    'FILIACAO' => 'filiacao',
                    'DT_EMISSAO' => 'dt_emissao',
                    'INSCRICAO' => 'titulo_eleitor',
                    'SECAO' => 'secao',
                    'ZONA' => 'zona',
                    'CODIGO_VALIDACAO' => 'codigo_validacao',
                ]
            ]
        ]
    ]
];
