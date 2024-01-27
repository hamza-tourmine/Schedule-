<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Groupe & Module Affectation | Formateur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body data-layout="detached" data-topbar="colored">
    <div class="container-fluid">
        <div class="main-content">
            <div class="page-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Formateur Validation</h4>
                                <p class="card-title-desc">Affecter votre modules et groupes</p>

                                <form id="form-horizontal" class="form-horizontal form-wizard-wrapper" action="{{ route('storeFormData') }}" method="POST">
                                    <h3>Modules</h3>
                                    <fieldset class="checkbox-group">
                                        <div class="row">
                                            @foreach($modules as $module)
                                            <div class="col-md-6">
                                                <div class="checkbox mb-3 row">
                                                    <label class="checkbox-wrapper">
                                                        <input type="checkbox" class="checkbox-input" name="selectedModules[]" value="{{ $module->id }}" />
                                                        <span class="checkbox-tile">
                                                            <span class="checkbox-label">{{ $module->module_name }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </fieldset>

                                    <h3>Groupes</h3>
                                    <fieldset class="checkbox-group">
                                        <div class="row">
                                            @foreach($groupes as $groupe)
                                            <div class="col-md-6">
                                                <div class="checkbox mb-3 row">
                                                    <label class="checkbox-wrapper">
                                                        <input type="checkbox" class="checkbox-input" name="selectedGroupes[]" value="{{ $groupe->id }}" />
                                                        <span class="checkbox-tile">
                                                            <span class="checkbox-label">{{ $groupe->group_name }}</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </fieldset>

                                    <h3>Groupe&Module Affectation</h3>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3 row">
                                                    <div class="wrapper">
                                                        <p class="selectstyle selectstyle--style1">
                                                            <label for="selectedGroup" class="selectstyle__label">Choose your Groupe</label>
                                                            <span class="selectstyle__box">
                                                                <select id="selectedGroup" name="selectedGroup" class="selectstyle__box__select">
                                                                    <option value="0">Groupe</option>
                                                                    <!-- Add options dynamically if needed -->
                                                                </select>
                                                            </span>
                                                        </p>

                                                        <p class="selectstyle selectstyle--style2">
                                                            <label for="selectedModule" class="selectstyle__label">Choose your Module</label>
                                                            <span class="selectstyle__box">
                                                                <select id="selectedModule" name="selectedModule" class="selectstyle__box__select">
                                                                    <option value="0">Module</option>
                                                                    <!-- Add options dynamically if needed -->
                                                                </select>
                                                            </span>
                                                        </p>

                                                        <p class="selectstyle selectstyle--style3">
                                                            <button type="submit">Save</button>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <h3>Confirm Detail</h3>
                                    <fieldset>
                                        <div class="p-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="flexCheckDefault1" />
                                                <label class="form-check-label" for="flexCheckDefault1">I agree with the Terms and Conditions.</label>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->
    </div>
    <!-- end container-fluid -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- form wizard -->
    <script src="{{ asset('assets/libs/jquery-steps/build/jquery.steps.min.js') }}"></script>

    <!-- form wizard init -->
    <script src="{{ asset('assets/js/pages/form-wizard.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    
</body>
</html>
