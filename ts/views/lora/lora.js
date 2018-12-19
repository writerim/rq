var converter_types = new ConverterTypes;

var meter_types = new MeterTypes;

// Создаем пустой экземпляр с которым пото будем работать
var LoraTableInfo = new LORA_TABLE_INFO();

var LoraBaseStation = new LORA_CONVERTER();



$( document ).ready( function(){
  
  
  LoraBaseStation.set('id' , lora_id );
  LoraBaseStation.fetch();
  
  LoraTableInfo.__set_model(LoraBaseStation);
  
  console.log( LoraTableInfo );
  console.log( LoraBaseStation );
});