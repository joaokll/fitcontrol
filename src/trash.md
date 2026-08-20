
    switch ($entrarOpcao) {
        case 'login':
            echo"Você escolheu a opção de se logar!";
            ?>
            <div class="container1">
                <form method="POST">
                    <label>Usuario:</label>
                    <input type="text" name="usuario" id="usuario1"> <br>
                    <label>Senha:</label>
                    <input type="password" name="senha" id="senha1"> <br>
                    <button type="submit">Login</button>
                </form>
            </div>
            <?php
            break;
        case 'registrar':
            echo"Você escolheu a opção de se registrar!";
            ?>
            <div class="container1">
                <form method="POST">
                    <label>Usuario:</label>
                    <input type="text" name="usuario" id="usuario2"> <br>
                    <label>Senha:</label>
                    <input type="password" name="senha" id="senha2"> <br>
                    <button type="submit">Registrar</button>
                    </form>
            </div>
            <?php
            break;
        default:
            # code...
            break;
    }



-- DADOS DE TESTE - USUARIOS

INSERT INTO usuarios (nome, email, senha, tipo) VALUES
('Carlos Personal', 'personal@fitcontrol.com', '123456', 'personal'),
('João Silva', 'joao@fitcontrol.com', '123456', 'aluno'),
('Maria Santos', 'maria@fitcontrol.com', '123456', 'aluno');

-- DADOS DE TESTE - ALUNOS

INSERT INTO alunos
(usuario_id, nome, cpf, telefone, data_nascimento, anamnese, vencimento_mensalidade)
VALUES
(2, 'João Silva', '111.111.111-11', '(81) 99999-1111', '1998-05-12',
 'Sem restrições médicas. Objetivo: ganho de massa muscular.',
 '2026-09-10'),

(3, 'Maria Santos', '222.222.222-22', '(81) 99999-2222', '2000-08-20',
 'Pratica exercícios regularmente. Objetivo: emagrecimento.',
 '2026-09-15'),

(NULL, 'Pedro Oliveira', '333.333.333-33', '(81) 99999-3333', '1995-03-10',
 'Possui experiência com musculação.',
 '2026-09-05'),

(NULL, 'Ana Costa', '444.444.444-44', '(81) 99999-4444', '1999-11-25',
 'Iniciante. Objetivo: condicionamento físico.',
 '2026-09-20');

-- DADOS DE TESTE - EXERCICIOS

INSERT INTO exercicios (nome, grupo_muscular, video_url) VALUES
('Supino Reto', 'Peito', 'https://www.youtube.com/watch?v=example1'),
('Agachamento Livre', 'Pernas', 'https://www.youtube.com/watch?v=example2'),
('Puxada Frontal', 'Costas', 'https://www.youtube.com/watch?v=example3'),
('Rosca Direta', 'Bíceps', 'https://www.youtube.com/watch?v=example4'),
('Tríceps Pulley', 'Tríceps', 'https://www.youtube.com/watch?v=example5');

-- DADOS DE TESTE - FICHAS DE TREINO

INSERT INTO fichas_treino
(aluno_id, nome_ficha, objetivo, data_inicio, data_fim, status)
VALUES
(1, 'A', 'Peito, ombros e tríceps', '2026-08-01', '2026-09-01', 'ativa'),
(1, 'B', 'Costas e bíceps', '2026-08-01', '2026-09-01', 'ativa'),
(2, 'A', 'Treino para emagrecimento', '2026-08-05', '2026-09-05', 'ativa');

-- DADOS DE TESTE - EXERCICIOS DAS FICHAS

INSERT INTO exercicios_ficha
(ficha_id, exercicio_id, series, repeticoes, carga, observacoes)
VALUES
(1, 1, 4, '10-12', 20.00, 'Executar com movimento controlado'),
(1, 2, 3, '10-12', 30.00, 'Manter postura correta'),
(2, 3, 4, '10-12', 25.00, 'Puxar até a altura do peito'),
(2, 4, 3, '12', 10.00, 'Evitar balançar o corpo'),
(3, 2, 3, '15', 20.00, 'Foco na execução');

-- DADOS DE TESTE - MENSALIDADES

INSERT INTO mensalidades
(aluno_id, valor, vencimento, data_pagamento, status)
VALUES
(1, 150.00, '2026-08-10', '2026-08-08', 'pago'),
(2, 150.00, '2026-08-15', NULL, 'pendente'),
(3, 150.00, '2026-08-05', '2026-08-04', 'pago'),
(4, 150.00, '2026-08-20', NULL, 'pendente');

https://www.svgrepo.com/collection/nonicons-programming-icons/

https://www.svgrepo.com/collection/scarlab-solid-oval-interface-icons/

https://www.svgrepo.com/collection/start-universal-tiny-oval-icons/

https://www.svgrepo.com/collection/software-mansion-curved-line-icons/

https://lobehub.com/icons
