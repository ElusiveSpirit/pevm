window.onload = function () {
  console.log('Start app');

  var data = {
    url: window.url,

    steps: [
      'type',
      'weaknesses',
      'solutions',
      'analysises',
    ],

    type: null,
    weaknesses: null,
    solutions: null,
    analysises: null,

    // Данные, которые выбрал пользователь
    currentData: {
      type: null,
      weaknesses: null,
      solutions: null,
      analysises: null
    },

    updateCurrentData: function (type, value) {
      data.currentData[type] = value;
    },

    updateData: function (callback) {
      var obj = this;
      $.ajax({
        type: 'GET',
        url: this.url,
        params: this.currentData,
        success: function (res) {
          var data = JSON.parse(res);
          console.log(data);

          obj.type = data.type;
          obj.weaknesses = data.weaknesses;
          obj.solutions = data.solutions;
          obj.analysises = data.analysises;

          callback();
        }
      });
    },

    emptyText: {
      type: 'Выберите тип уязвимости в выпадающем меню',
      weaknesses: 'Выберите уязвимость в выпадающем меню',
      solutions: 'Выберите решение уязвимости в выпадающем меню',
      analysises: 'Выберите анализ решения в выпадающем меню'
    },
    linksText: {
      type: 'Тип уязвимости',
      weaknesses: 'Уязвимость',
      solutions: 'Решение',
      analysises: 'Анализ'
    }
  };
  window.data = data;

  function clearActive() {
    console.log('Clear active nav links');

    $('a.nav-link').removeClass('active');

    data.steps.forEach(step => {
      $(`.nav-link[data-class="${step}"]`).html(data.linksText[step]);
    })
  }

  function updateDropdowns() {
    console.log('Update dropdows data');

    data.steps.forEach(step => {
      var dataObj = data[step];

      if (dataObj) {
        $(`.nav-link[data-class="${step}"] + .dropdown-menu`)
          .first()
          .html(Object.keys(dataObj).map(key => `<div class="dropdown-item" value="${key}">${dataObj[key]}</div>`));
      }
    })
  }

  function initStep () {
    console.log('Init current step');
    clearActive();
    updateDropdowns();

    var activeFound = false;
    for (var i = 0; i < data.steps.length; i++) {
      var step = data.steps[i];
      if (activeFound) {
        $(`.nav-link[data-class="${step}"]`).addClass('disabled');
      } else if (!data.currentData[step]) {
        activeFound = true;
        $(`.nav-link[data-class="${step}"]`).addClass('active');
        $('#wrapper').html(`<h4 class="text-center mt-5">${data.emptyText[step]}</h4>`);
      } else {
        $(`.nav-link[data-class="${step}"]`).html(
          data[step][data.currentData[step]]
        );

      }
    }
  }

  $(document).on('click', '.dropdown-item', function () {
    var value = $(this).attr('value');
    var type = $(this).parent().parent().children().first().attr('data-class');

    console.log(`Button was clicked. type='${type}', value='${value}'`);

    data.updateCurrentData(type, value);
    data.updateData(initStep);
  });


  data.updateData(initStep);
};
