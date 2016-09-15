String.prototype.endsWith = function(suffix) {
    return this.indexOf(suffix, this.length - suffix.length) !== -1;
};

String.prototype.startsWith = function(prefix) {
    return this.indexOf(prefix) === 0;
};


function dictionaryLookup(verb) {
  $.ajax({
      dataType: "json",
      url: "proxy.php",
      type:"GET",
      data: {
          "keyword": verb
      },
      crossDomain: true,
      success: function(data, textStatus, jqXHR) {
          $resultsList.html("");
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

              $resultsList.append(newRow);

          }
          $dictPanel.slideDown(400);
      }
  });
}

function conjugateVerb(verbRomaji) {
  var verbClass = checkType(verbRomanji);
  var message = "Error: No verb class";
  var success = true;
  console.log("Class: " + verbClass);

  switch ( verbClass ) {
      case 0:
          message = "Invalid verb";
          success = false;
          break;
      case 1:
          message = "Class 1 verb (五段 - godan)";
          conjugation = conjugateClass1(verbRomanji);
          conjugation = furtherConjugations(conjugation, 1);
      break;
      case 2:
          message = "Class 2 verb (一段 - ichidan)";
          conjugation = conjugateClass2(verbRomanji);
          conjugation = furtherConjugations(conjugation, 2);
      break;

      case 3:
          message = "Irregular verb";
          conjugation = conjugateClass3(verbRomanji);
          conjugation = furtherConjugations(conjugation, 3);
      break;
  }
  return {
    message: message,
    conjugation: conjugation,
    verbClass: verbClass,
    success: success
  }
}
/**
 * Submits the verb
 */
function verbSubmit() {
    var verb = $verbField.val();

    if ( !wanakana.isKana(verb) ) {
        verb = wanakana.toKana(verb);
    }

    document.location.hash = verb;

    $("#verbHeader").text(verb);

    $dictPanel.slideUp(200);

    dictionaryLookup(verb);

    verbRomanji = wanakana.toRomaji(verb);
    console.log("Verb: " + verb + " " + verbRomanji);

    verbClass = checkType(verbRomanji);
    console.log("Class: " + verbClass);

    var conjugateData = conjugateVerb(verbRomanji);

    $("#verbInfo").text(conjugateData.message);
    if ( conjugateData.success ) {
      fillTable(conjugateData.conjugation, conjugateData.verbClass);
      $conjugationTable.slideDown(200);
    } else {
      $conjugationTable.slideUp(200);
    }
}

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

var conjRowTemplate = null;
var jishoRowTemplate = null;
var $verbField = null;
var $conjugationTable = null;
var $dictPanel = null;
var $resultsList = null;

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
