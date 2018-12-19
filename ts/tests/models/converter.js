QUnit.test( "hello test", function( assert ) {
  assert.ok( 1 == "1", "Passed!" );
});

QUnit.test( "converter_set_about", function( assert ) {
  var test_converter = new CONVERTER_MODEL({about : 'test_0'});
  test_converter.set('about', 'test_1')
  assert.ok( test_converter.get('about') == "test_1", "Passed!" );
});
