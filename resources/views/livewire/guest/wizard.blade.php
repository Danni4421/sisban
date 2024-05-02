<div class="my-3 rounded" id="wizard">
    <div class="step process @if ((int) $formIndex <= 1) unprocessed @endif">
        <div class="inner_content" id="first_step">
            <div class="icon_step @if ($formIndex == 1) active @endif">
                <i class='bx bx-user'></i>
            </div>
            <span class="step_detail">Data Diri</span>
        </div>
    </div>
    <div class="step process @if ((int) $formIndex <= 2) unprocessed @endif">
        <div class="inner_content" id="second_step">
            <div class="icon_step @if ($formIndex == 2) active @endif">
                <i class='bx bx-user-plus' ></i>
            </div>
            <span class="step_detail">Data Keluarga</span>
        </div>
    </div>
    <div class="step process @if ((int) $formIndex <= 3) unprocessed @endif">
        <div class="inner_content" id="third_step">
            <div class="icon_step @if ($formIndex == 3) active @endif">
                <i class='bx bx-car' ></i>
            </div>
            <span class="step_detail">Kepemilikan Aset</span>
        </div>
    </div>
    <div class="step finished unprocessed">
        <div class="inner_content" id="last_step">
            <div class="icon_step @if ($formIndex == 4) active @endif">
                <i class='bx bx-money' ></i>
            </div>
            <span class="step_detail">Kondisi Ekonomi</span>
        </div>
    </div>
</div>
