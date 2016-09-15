QUnit.test( "init test", function( assert ) {
  assert.ok( 1 == "1", "Everything works fine." );
});

QUnit.test( "Class 1 verbs", function( assert ) {

  assert.ok( 1 == "1", "Everything works fine." );
});

QUnit.test( "Class 2 verbs", function( assert ) {
  assert.ok( 1 == "1", "Everything works fine." );
});

QUnit.test( "Class 3 verbs", function( assert ) {
  var suru = conjugateClass3('suru');
  assert.ok ( suru.a.base  == 'shinai'  , "する - あ base conjugation pass");
  assert.ok ( suru.i.base  == 'shimasu' , "する - い base conjugation pass");
  assert.ok ( suru.u.base  == 'suru'    , "する - う base conjugation pass");
  assert.ok ( suru.e.base  == 'sureba'  , "する - え base conjugation pass");
  assert.ok ( suru.o.base  == 'shiyou'  , "する - お base conjugation pass");
  assert.ok ( suru.te.base == 'shite'   , "する - て base conjugation pass");


  var kuru = conjugateClass3('kuru');
  assert.ok ( kuru.a.base  == 'konai'  , "くる - あ base conjugation pass");
  assert.ok ( kuru.i.base  == 'kimasu' , "くる - い base conjugation pass");
  assert.ok ( kuru.u.base  == 'kuru'    , "くる - う base conjugation pass");
  assert.ok ( kuru.e.base  == 'kureba'  , "くる - え base conjugation pass");
  assert.ok ( kuru.o.base  == 'koyou'  , "くる - お base conjugation pass");
  assert.ok ( kuru.te.base == 'kite'   , "くる - て base conjugation pass");
});

QUnit.test( "All verb classes", function( assert ) {
  assert.ok( 1 == "1", "Everything works fine." );
});
