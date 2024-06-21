<div class="content-filtro">
    <form action="" class="filtro_vagas" method="get">
        <p style="margin: 0; font-size: 1.1em;"><b>Filtrar por</b></p>
        <hr style="width: 100%; margin: 5px 0">
        <label for="area" style="margin: 0 0 5px;"><b>Área</b></label>
        <select name="area" id="area" style="text-indent: 3px;">
            <option value="">Selecionar Área</option>
            <option value="Administração">Administração</option>
            <option value="Direito">Direito</option>
            <option value="Edição audiovisual">Edição audiovisual</option>
            <option value="Engenharia">Engenharia</option>
            <option value="Finanças">Finanças</option>
            <option value="Marketing">Marketing</option>
            <option value="Saúde">Saúde</option>
            <option value="Tecnologia (TI)">Tecnologia (TI)</option>
        </select>

        <label for="remuneracao_maior"><b>Remuneração</b></label>
        Maior que ou igual a<input type="number" name="remuneracao_maior" id="remuneracao_maior">
        Menor que ou igual a<input type="number" name="remuneracao_menor" id="remuneracao_menor">

        <button type="submit" class="btn-filtro" name="submit">Aplicar Filtros</button>
        <button type="submit" class="btn-filtro" name="submit_clean">Limpar Filtros</button>
    </form>
</div>
