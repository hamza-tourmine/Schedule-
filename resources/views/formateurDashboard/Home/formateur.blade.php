<x-HeaderMenuFormateur>
    <div class="row">
        <div class="col-md-12 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="profile-widgets py-3">

                        <div class="text-center">
                            <div class="">
                                <img src="{{ asset('uploads/' . Auth::user()->image) }}" alt="Profile picture"
                                    class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                <div class="online-circle"><i class="fas fa-circle text-success"></i>
                                </div>
                            </div>

                            <div class="mt-3 ">
                                <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->user_name }}</span>
                                <p class="text-body mt-1 mb-1">{{ Auth::user()->domaine }}</p>


                            </div>

                            <div class="row mt-4 border border-start-0 border-end-0 p-3">
                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        Nombres des demandes
                                    </h6>
                                    @php
                                        $user = Auth::user();
                                        $DemandesList = \App\Models\RequestEmploi::where('user_id', $user->id)->count();
                                    @endphp
                                    <h5 class="mb-0">{{ $DemandesList }}</h5>
                                </div>

                                <div class="col-md-6">
                                    <h6 class="text-muted">
                                        Nombres des seances
                                    </h6>
                                    @php
                                        $user = Auth::user();
                                        $seancesList = \App\Models\sission::where('user_id', $user->id)->count();
                                    @endphp
                                    <h5 class="mb-0">{{$seancesList}}</h5>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Personal Information</h5>


                    <div class="mt-3">
                        <p class="font-size-12 text-muted mb-1">Matricule</p>
                        <h6 class="">{{ Auth::user()->id }} </h6>
                    </div>
                    <div class="mt-3">
                        <p class="font-size-12 text-muted mb-1">Nom complet</p>
                        <h6 class="">{{ Auth::user()->user_name }}</h6>
                    </div>
                    <div class="mt-3">
                        <p class="font-size-12 text-muted mb-1">Domaine du formation</p>
                        <h6 class="">{{ Auth::user()->domaine }}</h6>
                    </div>

                    <div class="mt-3">
                        <p class="font-size-12 text-muted mb-1">Email Address</p>
                        <h6 class="">{{ Auth::user()->email }}</h6>
                    </div>



                </div>
            </div>



        </div>

        <div class="col-md-12 col-xl-9">


            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liste Des Groupes</h4>

                    <table id="FormateurGroupesTable" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Nom Du Groupe</th>
                                <th>Branch</th>
                                <th>Year</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (isset($GroupsList) && $GroupsList->count() > 0)
                                @php $counter = 0; @endphp
                                @foreach ($GroupsList as $GroupList)
                                    @php
                                        $groupName = \App\Models\Group::find($GroupList['group_id'])->group_name;
                                        $groupBranch = \App\Models\Group::find($GroupList['group_id'])->barnch_id;
                                        $groupYear = \App\Models\Group::find($GroupList['group_id'])->year;
                                    @endphp
                                    <tr @if ($counter >= 3) style="display: none;" @endif>
                                        <td>{{ $groupName }}</td>
                                        <td>{{ $groupBranch }}</td>
                                        <td>{{ $groupYear }}</td>
                                    </tr>
                                    @php $counter++; @endphp
                                @endforeach
                                @if ($counter > 3)
                                    <tr id="showMoreRow">
                                        <td colspan="3">
                                            <a href="{{ url('FormateurGroupeList') }}" class="btn btn-primary">Show
                                                More</a>
                                        </td>
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td colspan="3">No groups assigned to this formateur</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @push('scripts')
                    <script>
                        $(document).ready(function() {
                            $('#showMoreBtn').click(function() {
                                $('tr:hidden').slice(0, 3).slideDown();
                                if ($('tr:hidden').length === 0) {
                                    $('#showMoreRow').hide();
                                }
                            });
                        });
                    </script>
                @endpush
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Liste Des modules</h4>

                    <table id="FormateurModulesTable" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Nom Du module</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (isset($modulesList) && $modulesList->count() > 0)
                                @php $counter = 0; @endphp
                                @foreach ($modulesList as $moduleList)
                                    @php
                                        $moduleName = \App\Models\Module::find($moduleList['module_id'])->module_name;
                                    @endphp
                                    <tr @if ($counter >= 3) style="display: none;" @endif>
                                        <td>{{ $moduleName }}</td>
                                    </tr>
                                    @php $counter++; @endphp
                                @endforeach
                                @if ($counter > 3)
                                    <tr id="showMoreModulesRow">
                                        <td colspan="1">
                                            <a href="{{ url('FormateurModuleList') }}" class="btn btn-primary">Show
                                                More</a>
                                        </td>
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td colspan="1">No modules assigned to this formateur</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            @push('scripts')
                <script>
                    $(document).ready(function() {
                        $('#showMoreModulesBtn').click(function() {
                            $('tr:hidden').slice(0, 3).slideDown();
                            if ($('tr:hidden').length === 0) {
                                $('#showMoreModulesRow').hide();
                            }
                        });
                    });
                </script>
            @endpush

        </div>


    </div>
</x-HeaderMenuFormateur>
