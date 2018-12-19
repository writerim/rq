/*
 * 
 * Вид отвечает за построение списка приборо учета на базовой станции
 * 
 */


/*
 * 
 * Ниже описаны модели для работы с вега сервером
 * 
 */
var ABR_MODEL = Backbone.Model.extend({
    defaults: {
        appsKey: "",
        devAddress: null,
        nwksKey: ""
    }
});

var OTAA_MODEL = Backbone.Model.extend({
    defaults: {
        appEui: "",
        appKey: "",
        last_join_ts: 0
    }
});

var CNANELMASK_MODEL = Backbone.Model.extend({
    defaults: {
        channel1En: true,
        channel2En: true,
        channel3En: true,
        channel4En: true,
        channel5En: true,
        channel6En: true,
        channel7En: true,
        channel8En: true,
        channel9En: false,
        channel10En: false,
        channel11En: false,
        channel12En: false,
        channel13En: false,
        channel14En: false,
        channel15En: false,
        channel16En: false
    }
});

var FREQUENCYPLAN_MODEL = Backbone.Model.extend({
    defaults: {
        freq4: 867100000,
        freq5: 867300000,
        freq6: 867500000,
        freq7: 867700000,
        freq8: 867900000
    }
});

var POSITION_MODEL = Backbone.Model.extend({
    defaults: {
        altitude: 0,
        latitude: 0,
        longitude: 0
    }
});

var SETTINGSAPPLYSTATUS_MODEL = Backbone.Model.extend({
    defaults: {
        channelMaskApllied: true,
        delayRx1Applied   : true,
        drRx2Applied      : true,
        freq4Applied      : true,
        freq5Applied      : true,
        freq6Applied      : true,
        freq7Applied      : true,
        freq8Applied      : true,
        freqRx2Applied    : true
    }
});

var LORA_DEVICE_MODEL = Backbone.Model.extend({
    defaults: {
        ABP         : new ABR_MODEL,
        OTAA        : new OTAA_MODEL,
        adr         : false,
        channelMask : new CNANELMASK_MODEL,
        class       : "CLASS_A",
        delayJoin1  : 5,
        delayJoin2  : 0,
        delayRx1    : 1,
        delayRx2    : 0,
        devEui      : "",
        devName     : "",
        drRx2       : 0,
        fcnt_down   : 0,
        fcnt_up     : 0,
        freqRx2     : 869525000,
        frequencyPlan: new FREQUENCYPLAN_MODEL,
        lastRssi    : 0,
        lastSnr     : 0,
        last_data_ts: 0,
        position    : new POSITION_MODEL,
        preferDr    : 5,
        preferPower : 14,
        reactionTime: 1000,
        rxWindow    : 2,
        serverAdrEnable: true,
        settingsApplyStatus: new SETTINGSAPPLYSTATUS_MODEL,
        useDownlinkQueueClassC: false
    },
    
    // Псевдо парсинг модели
    // Сюда надо засовывать JSON от БС
    // В противном случае будет объект у которого будет структура на объектами а простым JSON
    __set: function(data) {
        this.set('ABP', new ABR_MODEL(data.ABP));
        this.set('OTAA', new OTAA_MODEL(data.OTAA));
        this.set('channelMask', new CNANELMASK_MODEL(data.channelMask));
        this.set('frequencyPlan', new FREQUENCYPLAN_MODEL(data.frequencyPlan));
        this.set('position', new POSITION_MODEL(data.position));
        return this.set('settingsApplyStatus', new SETTINGSAPPLYSTATUS_MODEL(data.settingsApplyStatus));
    }
});

var LORA_DEVICE_COLLECTION = Backbone.Collection.extend({
    model: LORA_DEVICE_MODEL,
    
    
    // Добавление прибора в коллекцию
    // Надо добавлять в коллекцию моделей нагрузки и моделей лоры
    __add: function(data) {
        var d, device, j, len, results;
        results = [];
        for (j = 0,
        len = data.length; j < len; j++) {
            device = data[j];
            d = new LORA_DEVICE_MODEL(device);
            d.__set(device);
            results.push(this.add(d));
        }
        return results;
    }
});


// Надслойка над приборами в системе в которые привязан прибор с вега сервера
var LORA_METER = METER_MODEL.extend({
  initialize : function(){
    this.set('lora_model' , new LORA_DEVICE_MODEL() );
  }
});
