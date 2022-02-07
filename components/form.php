<?php if (!empty($erros)) : ?>
    <div class="alert alert-danger">
        <?php foreach ($erros as $erro) : ?>
            <div><?php echo $erro ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="container-flex">
    <div class="flexbox-item flexbox-item-column">
        <a class="btn-listar" href="index.php" role="button">Listar apontamentos</a>
    </div>
    <div class="flexbox-item flexbox-item-2">
        <form action="" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            <br>
            <label class="form-label m-1">Descrição</label>
            <input type="text" required class="form-control" placeholder="Descrição" name="desc" value="<?php echo $desci ?>">
            <br>
            <label class="form-label m-1">Nota</label>
            <input class="form-control" placeholder="Nota" type="textarea" name="nota" required value="<?php echo $nota ?>">
            <br>
            <label class="form-label">Tipo apontamento</label>
            <select class="form-select" id="id_tipo_apontamento" name="id_tipo_apontamento" required>
         
                    <?php
                    while ($row = $combo->fetch()) {
                    if($row['id_tipo_apontamento']==$idTpApont['id_tipo_apontamento'])
                    {}else{?>
                <option value="<?php echo $row['id_tipo_apontamento']; ?>"><?php echo $row['descricao']; ?></option>
            <?php
                    }    
                }
            ?>
            </select>

            <br>

            <label class="custom-file-label" for="imagem" data-browse="Procurar fotografia">Selecione imagem do apontamento</label>
            <input type="file" id="imagem" name="imagem" value="<?php echo $imagem ?>">
            <br>

            <label class="form-label m-1">Visualizar</label>
            <div class="flexbox-item flexbox-item-row" style="height:fit-content;">
                <?php if($visualizar == 1){?>
                    <input class="form-check-input" type="radio" name="visualizar" value="sim" id="flexRadioDefault1" checked>
                <label class="form-check-label" for="flexRadioDefault1">
                    Sim
                </label>
                <input class="form-check-input" type="radio" name="visualizar" value="não" id="flexRadioDefault2" >
                <label class="form-check-label" for="flexRadioDefault2">
                    Não
                </label>
               <?php } else { ?> 
                <input class="form-check-input" type="radio" name="visualizar" value="sim" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Sim
                </label>
                <input class="form-check-input" type="radio" name="visualizar" value="não" id="flexRadioDefault2" checked>
                <label class="form-check-label" for="flexRadioDefault2">
                    Não
                </label>
                <?php } ?>
               
            </div>


    </div>
    <div class="flexbox-item flexbox-item-2 voltar-submit">
        <button class="btn-voltar  " role="button" class="btn-voltar">Submeter</button>
            <a class="btn-voltar " href="index.php">Voltar</a>
    </div>
    </form>
</div>