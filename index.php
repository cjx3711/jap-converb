<?php
$rootColour = "#265759";
$middleColour = "#C7384D";
$restColour = "#06BF5F";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Verbs</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    .rootKana {
        color: <?= $rootColour ?>;
    }
    .middleKana {
        color: <?= $middleColour ?>;
    }
    .endingKana {
        color: <?= $restColour ?>;
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Testing</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Verb Conjugator</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h1>Japanese Verb Conjugator</h1>
            </div>
            <br/>
            <div class="col-sm-6 col-md-4">
                <div class="row">
                    <div class="col-xs-12 well">
                        <h2>Enter verb here:</h2>
                        <p>Type in romaji</p>
                        <form class="form" id="verbInput">
                            <div class="input-group" style="width:100%; margin-bottom:10px;">
                                <input class="form-control" type="text" id="verbField"  />
                            </div>
                            <div class="input-group" style="width:100%; margin-bottom:10px;">
                                <input class="form-control btn btn-primary" type="submit" id="submit" value="submit"/>
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-12 well" id="dictPanel">
                        <h2>Dictionary</h2>
                        <p>Powered by <a href="http://www.jisho.org" target="_blank">jisho.org</a></p>
                        <p><a href="http://www.jisho.org/search/" id="completeResults">See complete results on jisho.org</a></p>
                        <ul class="resultsList list-group">

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-8">
                <h2><span id="verbHeader"></span></h2>
                <p id="verbInfo"></p>

                <table class="table table-bordered conjugationTable">
                    <thead>
                        <tr>
                            <th>ない form</th>
                            <th>ます form</th>
                            <th>dict form</th>
                            <th>conditional form</th>
                            <th>volitional form</th>
                            <th>て form</th>
                        </tr>
                    </thead>
                    <tbody id="conjRows">
                        <tr>
                            <td>
                                <div id="a" class="baseForm">

                                </div>
                            </td>
                            <td>
                                <div id="i" class="baseForm">

                                </div>
                            </td>
                            <td>
                                <div id="u" class="baseForm">

                                </div>
                            </td>
                            <td>
                                <div id="e" class="baseForm">

                                </div>
                            </td>
                            <td>
                                <div id="o" class="baseForm">

                                </div>
                            </td>
                            <td>
                                <div id="te" class="baseForm">

                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wanakana.min.js"></script>

    <script type="text/template" id="jishoRowTemplate">
        <li class="list-group-item">
            <h4>_TITLE_</h4>
            <p>_DEFINITION_</p>
            <p><small>_PARTS_</small></p>
        </li>
    </script>

    <script type="text/template" id="conjRowTemplate">
        <tr id="row-_ROW_" class="extendedFormRow">
            <td>
                <div id="a-_ROW_" class="a extendedForms">

                </div>
            </td>
            <td>
                <div id="i-_ROW_" class="i extendedForms">

                </div>
            </td>
            <td>
                <div id="u-_ROW_" class="u extendedForms">

                </div>
            </td>
            <td>
                <div id="e-_ROW_" class="e extendedForms">

                </div>
            </td>
            <td>
                <div id="o-_ROW_" class="o extendedForms">

                </div>
            </td>
            <td>
                <div id="te-_ROW_" class="te extendedForms">

                </div>
            </td>
        </tr>
    </script>
    <script src="js/script.js"></script>
    <script>
    $(document).ready ( function () {
      // Init the selectors
      conjRowTemplate = $("#conjRowTemplate").html();
      jishoRowTemplate = $("#jishoRowTemplate").html();
      $verbField = $("#verbField");
      $conjugationTable =$(".conjugationTable");
      $dictPanel = $("#dictPanel");
      $resultsList = $(".resultsList");

      var input = document.getElementById('verbField');
      wanakana.bind(input);
      $conjugationTable.hide();
      $dictPanel.hide();

      word = document.location.hash;
      if ( word.length > 0 || word.startsWith("#") ) word = word.substring(1);
      $verbField.val(wanakana.toKana(word));
      verbSubmit();

      window.onhashchange = function() {
          word = document.location.hash;
          if ( word.length > 0 || word.startsWith("#") ) word = word.substring(1);
          $verbField.val(wanakana.toKana(word));
          verbSubmit();
      }

      $("#verbInput").submit(function (e) {
          e.preventDefault();
          verbSubmit();
      });
    });
    </script>

</body>

</html>
