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

    <script>

    String.prototype.endsWith = function(suffix) {
        return this.indexOf(suffix, this.length - suffix.length) !== -1;
    };

    String.prototype.startsWith = function(prefix) {
        return this.indexOf(prefix) === 0;
    };

    var conjRowTemplate = $("#conjRowTemplate").html();
    var jishoRowTemplate = $("#jishoRowTemplate").html();

    $(document).ready ( function () {
        var input = document.getElementById('verbField');
        wanakana.bind(input);
        $(".conjugationTable").hide();
        $("#dictPanel").hide();

        word = document.location.hash;
        if ( word.length > 0 || word.startsWith("#") ) word = word.substring(1); 
        $("#verbField").val(wanakana.toKana(word));
        verbSubmit();

        window.onhashchange = function() {
            word = document.location.hash;    
            if ( word.length > 0 || word.startsWith("#") ) word = word.substring(1); 
            $("#verbField").val(wanakana.toKana(word));
            verbSubmit();
        }

        


        
        //$("#verbField").


        function verbSubmit() {
            var verb = $("#verbField").val();

            if ( !wanakana.isKana(verb) ) {
                verb = wanakana.toKana(verb);
            }

            document.location.hash = verb;

            $("#verbHeader").text(verb);

            $("#dictPanel").slideUp(200);

            $.ajax({
                dataType: "json",
                url: "proxy.php",
                type:"GET",
                data: {
                    "keyword": verb
                },
                crossDomain: true,
                success: function(data, textStatus, jqXHR) {
                    $(".resultsList").html("");
                    for ( i = 0; i < data.data.length && i < 3; i++ ) {
                        jap = data.data[i].japanese;
                        word = jap[0].word;
                        reading = jap[0].reading;
                        senses = data.data[i].senses;
                        eng = senses[0].english_definitions;
                        partsofspeech = senses[0].parts_of_speech;

                        $("#completeResults").attr("href", "http://www.jisho.org/search/"+verb);

                        if ( typeof word == "undefined") word = reading;
                        if ( typeof reading == "undefined") reading = word;

                        reading = wanakana.toHiragana(reading);

                        definitions = "";
                        for (d = 0; d < eng.length; d++) {
                            definitions += (d+1) + ". " + eng[d];
                            if ( d < eng.length - 1 ) definitions += "<br/>";
                        }

                        parts = "";
                        for (d = 0; d < partsofspeech.length; d++) {
                            parts += partsofspeech[d];
                            if ( d < partsofspeech.length - 1 ) parts += "<br/>";
                        }

                        newRow = jishoRowTemplate
                        .replace(/_TITLE_/g, word + " (" + reading + ")" )
                        .replace(/_DEFINITION_/g, definitions)
                        .replace(/_PARTS_/g, parts);

                        $(".resultsList").append(newRow);

                    }
                    $("#dictPanel").slideDown(400);
                }
            });



            verbRomanji = wanakana.toRomaji(verb);
            console.log("Verb: " + verb + " " + verbRomanji);

            verbClass = checkType(verbRomanji);
            console.log("Class: " + verbClass);


            switch ( verbClass ) {
                case 0:
                    $("#verbInfo").text("Invalid verb");
                    $(".conjugationTable").slideUp(200);

                return;
                case 1:
                    $("#verbInfo").text("Class 1 verb (五段 - godan)");
                    conjugation = conjugateClass1(verbRomanji);
                    conjugation = furtherConjugations(conjugation, 1);
                    fillTable(conjugation, 1);
                    $(".conjugationTable").slideDown(200);
                break;
                case 2:
                    $("#verbInfo").text("Class 2 verb (一段 - ichidan)");
                    conjugation = conjugateClass2(verbRomanji);
                    conjugation = furtherConjugations(conjugation, 2);
                    fillTable(conjugation, 2);
                    $(".conjugationTable").slideDown(200);
                break;

                case 3:
                    $("#verbInfo").html("Irregular verb");
                    conjugation = conjugateClass3(verbRomanji);
                    conjugation = furtherConjugations(conjugation, 3);
                    fillTable(conjugation, 3);
                    $(".conjugationTable").slideDown(200);

                break;
            }
        }

        $("#verbInput").submit(function (e) {
            e.preventDefault();
            verbSubmit();
        });

        function fillTable ( conj, verbClass ) {
            isClass1 = verbClass==1;
            $(".baseForm#a").html(  japWordDisplay( conj.a.base,    conj.a.root,    isClass1 ));
            $(".baseForm#i").html(  japWordDisplay( conj.i.base,    conj.i.root,    isClass1 ));
            $(".baseForm#u").html(  japWordDisplay( conj.u.base,    conj.u.root,    isClass1 ));
            $(".baseForm#e").html(  japWordDisplay( conj.e.base,    conj.e.root,    isClass1 ));
            $(".baseForm#o").html(  japWordDisplay( conj.o.base,    conj.o.root,    isClass1 ));
            $(".baseForm#te").html( japWordDisplay( conj.te.base,   conj.te.root,   isClass1 ));

            maxLength = 0;
            for ( var con in conj ) {
                if ( conj[con].further.length > maxLength ) maxLength = conj[con].further.length;
            }

            $(".extendedFormRow").remove();

            for ( i = 0; i < maxLength; i++ ) {
                $("#conjRows").append($(conjRowTemplate.replace(/_ROW_/g, i )));
            }


            for ( var con in conj ) {
                consonantLength =  conj[con].further.length;
                root = conj[con].root;
                //console.log(conj[con].further);
                //console.log(conj[con].root);
                for ( i = 0; i < consonantLength; i++ ) {
                    extended = conj[con].further[i];
                    id = con + "-" + i;
                    $("#"+id).html(extended.e+"<br/>"+japWordDisplay(extended.j, root, isClass1));
                }
            }



        }
        
        function japWordDisplay ( word, root, isClass1 ) {
            if ( word == null || root == null ) return word;
            html = "";
            list = word.split("\|");
            rootKana = wanakana.toHiragana(root).replace("t", "っ");
            startKana = rootKana;
            middleKana = "";
            if ( isClass1 ) {
                startKana = rootKana.substring(0,rootKana.length-1);
                middleKana = rootKana.substring(rootKana.length-1);
            }
            
            for (j = 0; j < list.length; j++) {
                wordKana = wanakana.toHiragana(list[j]);
                //console.log("Displaying: " + "("+rootKana+") " + wordKana );
                if ( wordKana.startsWith(rootKana) ) {
                    //Styled display
                    restofKana = wordKana.substring(rootKana.length);

                    html += "<span class='rootKana'>";
                    html += startKana;
                    html += "</span>";
                    if ( isClass1 ) {
                        html += "<span class='middleKana'>";
                        html += middleKana;
                        html += "</span>";
                    }
                    html += "<span class='endingKana'>";
                    html += restofKana;
                    html += "</span>";
                } else {
                    //Do normal unstyled display
                    html += wordKana;
                }
                if ( j < list.length-1) html += "<br/>";
            }

            return html;
            
        }

        function furtherConjugations ( conjugation, verbClass ) {
            //a conjugations
            a = [];
            aBase = conjugation.a.base;
            aRoot = aBase.substring(0,aBase.length-3); //Remove the nai
            if (aBase=="aranai") conjugation.a.base="nai";
            a.push({
                "e": "Please do not ...",
                "j": aBase + " dekudasai"
            });
            a.push({
                "e": "(I) may not ...",
                "j": aBase + " kamoshirenai" + "|" + aBase + " kamoshiremasen"
            });
            a.push({
                "e": "(You) don't have to ...",
                "j": aRoot + "taku temoiidesu"
            });
            a.push({
                "e": "(You) must ...",
                "j": aRoot + "nakereba ikemasen" + "|" + aRoot + "nakereba narimasen"
            });

            //i conjugations
            i = [];
            iBase = conjugation.i.base;
            iRoot = iBase.substring(0,iBase.length-4); //Remove the masu

            i.push({
                "e": "Let's ...",
                "j": iRoot + "mashou"
            });

            i.push({
                "e": "(I) want to ...",
                "j": iRoot + "tai"
            });

            i.push({
                "e": "(I) don't want to ...",
                "j": iRoot + "takunai"
            });

            i.push({
                "e": "Why don't (we) ...",
                "j": iRoot + "masenka"
            });

            //u conjugations
            u = [];
            uBase = conjugation.u.base;
            uRoot = uBase.substring(0,uBase.length-(verbClass==1?0:2)); //Remove the ru if class 2 or 3
            u.push({
                "e": "(I) may ...",
                "j": uBase + " kamoshirenai" + "|" + uBase + " kamoshiremasen"
            });
            u.push({
                "e": "(I) intend to ...",
                "j": uBase + " tsumorida" + "|" + uBase + " tsumoridesu"
            });
            u.push({
                "e": "like ... ing",
                "j": uBase + " kotoga sukidesu"
            });
            //e conjugations
            e = [];
            eBase = conjugation.e.base;
            eRoot = eBase.substring(0,eBase.length-(verbClass==1?2:4)); //Remove the ba if class 1 else reba
            
            e.push({
                "e": "Is it alright if (I) ...",
                "j": eBase + " iidesuka"
            });
            potential = "";
            if ( verbClass == 3 ) {
                if ( uBase == "suru")
                    potential = "dekiru|dekimasu";
                else if ( uBase == "kuru")
                    potential = "korareru|koraremasu";
            } else { //Normal cases of potential form
                rare = "";
                if ( verbClass == 2 ) rare = "rare";
                potential = eRoot + rare + "ru" + "|" + eRoot + rare + "masu";
            }
            e.push({
                    "e": "<strong>[Potential Verb]</strong><br/>Can do ... ",
                    "j": potential
                })
            
            //o conjugations
            o = [];
            oBase = conjugation.o.base;
            oRoot = oBase.substring(0,oBase.length-(verbClass==1?1:3)); //Remove the u if class 1 else you

            o.push({
                "e": "(I) think (I) will ...",
                "j": oBase + " toomoimasu"
            });
            o.push({
                "e": "(I) have been thinking of doing ...",
                "j": oBase + " toomoteimasu"
            });

            //te conjugations
            te = [];
            teBase = conjugation.te.base;
            teRoot = teBase.substring(0,teBase.length-2); //Remove the te (This is also the gerund)

            te.push({
                "e": "<strong>[Present Progressive]</strong><br/>doing ...",
                "j": teBase + " imasu"
            });

            te.push({
                "e": "Please do ...",
                "j": teBase + " kudasai"
            });
            te.push({
                "e": "(You) should not",
                "j": teBase + "haikemasenn"
            });
            te.push({
                "e": "do ... and see how",
                "j": teBase + "mimasu"
            });

            conjugation.a.further = a;
            conjugation.a.root = aRoot;
            conjugation.i.further = i;
            conjugation.i.root = iRoot;
            conjugation.u.further = u;
            conjugation.u.root = uRoot;
            conjugation.e.further = e;
            conjugation.e.root = eRoot;
            conjugation.o.further = o;
            conjugation.o.root = oRoot;
            conjugation.te.further = te;
            conjugation.te.root = teRoot;

            return conjugation;
        }

        function conjugateClass3 ( verb ) {
            if ( verb == "kuru" ) return conjugateKuru ( verb );
            if ( verb == "suru" ) return conjugateSuru ( verb );
        }
        function conjugateKuru ( verb ) {
            if ( verb != "kuru" ) return null;
            var ret = {
                "a": {
                    "base": "konai"
                },
                "i": {
                    "base": "kimasu"
                },
                "u": {
                    "base": "kuru"
                },
                "e": {
                    "base": "kureba"
                },
                "o": {
                    "base": "koyou"
                },
                "te": {
                    "base": "kite"
                }
            }
            return ret;
        }

        function conjugateSuru ( verb ) {
            if ( verb != "suru" ) return null;
            var ret = {
                "a": {
                    "base": "shinai"
                },
                "i": {
                    "base": "shimasu"
                },
                "u": {
                    "base": "suru"
                },
                "e": {
                    "base": "sureba"
                },
                "o": {
                    "base": "shiyou"
                },
                "te": {
                    "base": "shite"
                }
            }
            return ret;
        }

        function conjugateClass1 ( verb ) {
            console.log("Conjugating class 1");
            verbKana = wanakana.toKana(verb);
            //Handler for the special wanai case
            var endings = ["あ","い","う","え","お"];
            var additionalW = "";
            for ( i = 0 ; i < endings.length; i++ ) {
                if ( verbKana.endsWith(endings[i]) ) {
                    additionalW = "w";
                    break;
                }
            }

            //Handler for te case
            frontPart = removeLastCharacter(verb);
            consonant = frontPart[frontPart.length - 1];
            if (additionalW == "w") consonant = "w";
            console.log("Consonant: " + consonant);
            teVerb = removeLastCharacter(frontPart+additionalW);
            switch ( consonant ) {
                case "w":
                case "t":
                case "r":
                    teVerb += "tte";
                    break;
                case "k":
                    teVerb += "ite";
                    break;
                case "g":
                    teVerb += "ide";
                    break;
                case "b":
                case "m":
                    teVerb += "nde";
                    break;
                case "s":
                    teVerb += "shite";
                    break;
                default:
                    teVerb = "ERA-";
            }
            
            var ret = {
                "a": {
                    "base": removeLastCharacter(verb) + additionalW + "anai"
                },
                "i": {
                    "base": removeLastCharacter(verb) + "imasu"
                },
                "u": {
                    "base": verb
                },
                "e": {
                    "base": removeLastCharacter(verb) + "eba"
                },
                "o": {
                    "base": removeLastCharacter(verb) + "ou"
                },
                "te": {
                    "base": teVerb
                },
            }

            return ret;
        }

        function conjugateClass2 ( verb ) {
            console.log("Conjugating class 2");
            verbKana = wanakana.toKana(verb);
            verbRootKana = removeLastCharacter(verbKana);
            verbRoot = wanakana.toRomaji(verbRootKana);

            var ret = {
                "a": {
                    "base": verbRoot + "nai"
                },
                "i": {
                    "base": verbRoot + "masu"
                },
                "u": {
                    "base": verb
                },
                "e": {
                    "base": verbRoot + "reba"
                },
                "o": {
                    "base": verbRoot + "you"
                },
                "te": {
                    "base": verbRoot + "te"
                },
            }

            return ret;
        }

        //Removes the last character, unless it's a tsu, then it removes two characters
        function removeLastCharacter ( str ) {
            if ( str.endsWith("tsu") ) return str.substring(0, str.length-2);
            return str.substring(0, str.length-1);
        }

        //Returns the type of verb.
        //1 for class 1, 2 for class 2, 3 for irregular, 0 for error
        //Precondition: Must be a romanji string
        function checkType ( verb ) {
            length = verb.length;
            if ( wanakana.toKana(verb).length < 2 ) return 0;
            if ( !verb.endsWith("u") ) return 0;
            if( verb == "kuru" || verb == "suru" ) return 3;
            if ( length < 3 ) { //Possibly class 1
                if ( length < 2 ) {
                    return 0;
                }
                return 1;
            } else { //Check for iru eru ending
                if ( verb.endsWith("iru") || verb.endsWith("eru") ) return 2;
                return 1;
            }
            

        }
    });

    


    </script>

   
</body>

</html>
