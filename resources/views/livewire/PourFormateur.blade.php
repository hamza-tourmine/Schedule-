
<thead>
    <tr>
        <th colspan="2">Jours</th>
        <th style="width: 120px !important;">SE1</th>
        <th style="width: 120px !important;">SE2</th>
        <th style="width: 120px !important;">SE3</th>
        <th style="width: 120px !important;">SE4</th>
    </tr>
</thead>
<tbody>
    @php
    $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    $abbreviations = ['Lundi' => 'Mon',
    'Mardi' => 'Tue',
    'Mercredi' => 'Wed',
    'Jeudi' => 'Thu',
    'Vendredi' => 'Fri',
    'Samedi' => 'Sat'];
    $sessionData = ['Formateur', 'Module', 'Salle'];
    @endphp

    @foreach ($days as $day)
    @foreach ($sessionData as $item)
    <tr>
        @if ($loop->first)
        <td rowspan="{{ count($sessionData) }}">{{ $day }}</td>
        @endif
        <td>{{ $item }}</td>
        @foreach (['SE1', 'SE2', 'SE3', 'SE4'] as $dure)
        <td data-bs-toggle="modal" data-bs-target="#exampleModal" class="Cases casesNewtamplate" id="{{ $abbreviations[$day] . (in_array($dure, ['SE1', 'SE2']) ? 'Matin' : 'Amidi') . $dure }}">
            @php
                $formateurs = [];
                $modules = [0];
            @endphp

            @foreach ($sissions as $sission)
                @if ($sission->day === $abbreviations[$day] && $sission->dure_sission === $dure)
                    @if ($item === 'Formateur')
                        @php
                            $formateurs[] = $sission->user_name;
                        @endphp
                    @elseif ($item === 'Module')
                    {{  $modules[0] = preg_replace('/^\d+/', '', $sission->module_name); }}
                    @elseif ($item === 'Salle')
                        {{ $sission->class_name }}
                    @endif
                @endif
            @endforeach
            {{ $formateurs ? $formateurs[0] : '' }}

        </td>

        @endforeach
    </tr>

    @endforeach
    <!-- end {{ $day }} -->
    @endforeach



</tbody>
