<tbody>
    @if ($groups)

        @foreach ($groups as $group)
            <tr>
                {{-- Mon --}}
                <td  data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases"
                    id="Mon{{ $group->id }}">                                @foreach ($sissions as $sission)
                        @if ($sission->day === 'Mon' && $sission->group_id === $group->id)
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>
                {{-- Tue --}}
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases"
                    id="Tue{{ $group->id }}">                                @foreach ($sissions as $sission)
                        @if ($sission->day === 'Tue' && $sission->group_id === $group->id)
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>
                {{-- Wed  --}}
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases"
                    id="Wed{{ $group->id }}">                                @foreach ($sissions as $sission)
                        @if ($sission->day === 'Wed' && $sission->group_id === $group->id)
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>
                {{-- Thu --}}
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases"
                    id="Thu{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Thu' && $sission->group_id === $group->id)
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>
                {{-- Fri --}}
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases"
                    id="Fri{{ $group->id }}">
                    @php
                        $caseid = 'Fri' . $group->id;
                    @endphp
                    @foreach ($sissions as $sission)
                        @if ($sission->day . $sission->group_id === $caseid)
                            {{ $sission->group_name }}<br />{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>
                {{-- Sat --}}
                <td data-bs-toggle="modal" data-bs-target="#exampleModal{{ $group->id }}" class="Cases"
                    id="Sat{{ $group->id }}">
                    @foreach ($sissions as $sission)
                        @if ($sission->day === 'Sat' && $sission->group_id === $group->id)
                            {{ $sission->group_name }}<br/>{{ $sission->class_name }}<br />{{ $sission->user_name }}
                        @endif
                    @endforeach
                </td>
            </tr>
            <div wire:ignore.self  class="modal fade col-9" id="exampleModal{{ $group->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel{{ $group->id }}" aria-hidden="true">
                @livewire('modal-component', ['classType'=>$classType,'salles'=>$salles ,'formateurs'=>$formateurs,'groups'=>$groups,'group' => $group, 'modules'=>$modules])

            </div>
        @endforeach
    @endif
</tbody>
