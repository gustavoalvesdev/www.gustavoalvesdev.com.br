<?php 

    if (isset($_POST['acao'])) {
        if (isset($_POST['nome']) && isset($_POST['email']) 
            && isset($_POST['telefone']) && isset($_POST['mensagem'])) {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $telefone = addslashes($_POST['telefone']);
            $mensagem = addslashes($_POST['mensagem']);

            $meuEmail = "contato@gustavoalvesdev.com.br";
            $headers = "From: $meuEmail\r\n";
            $headers .= "Reply-To: $email\r\n";

            $assunto = "FORMULÁRIO DO SITE";

            $corpo = "Formulário enviado\n";
            $corpo .= "Nome: ".$nome."\n";
            $corpo .= "E-mail: ".$email."\n";
            $corpo .= "Telefone: ".$telefone."\n";
            $corpo .= "Mensagem: ".$mensagem."\n";

            $email_to = "contato@gustavoalvesdev.com.br";

            $status = mail($email_to, $assunto, $corpo, $headers);

            if ($status) {
                echo '<script>alert("Contato enviado com sucesso! Responderemos em breve");</script>';
            } else {
                echo '<script>alert("Falha ao enviar contato. Tente novamente mais tarde ou envie e-mail para: contato@gustavoalvesdev.com.br");</script>';
            }
        }
        
    }

    
?>
<section class="contato">
    <div class="container">
        <div class="line-text">
            <div style="width:75px;"></div>
            <h2>Contato</h2>
        </div>
        <!-- line-text -->

        <div class="contato-info wow bounceInUp">
            <p><i class="fab fa-whatsapp"></i> (11) 99653-1308</p>
            <p><i class="far fa-envelope"></i> contato@gustavoalvesdev.com.br</p>
        </div>
        <!-- contato-info -->

        <form class="wow bounceInLeft" method="POST">
            <div class="input-wrapper w100">
                <input type="text" placeholder="Nome*" name="nome" id="nome" required />
            </div>
            <!-- input-wrapper -->
            <div class="input-wrapper w50">
                <input type="email" placeholder="E-mail*" name="email" id="email" required />
            </div>
            <!-- input-wrapper -->
            <div class="input-wrapper w50">
                <input type="tel" placeholder="Telefone / Celular / Whatsapp" name="telefone" id="telefone" required />
            </div>
            <!-- input-wrapper -->
            <div class="input-wrapper w100">
                <textarea placeholder="Mensagem*" name="mensagem" required></textarea>
            </div>
            <!-- input-wrapper -->
            <div class="input-wrapper w100">
                <input class="btn-contato" type="submit" name="acao" value="Enviar" />
            </div>
            <!-- input-wrapper -->
            <div class="clear"></div>
        </form>
    </div>
    <!-- container -->
</section>
<!-- contato -->