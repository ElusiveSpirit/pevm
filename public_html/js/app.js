window.onload = function () {
  console.log('Start app');

  var data = {
    url: window.url,
    urlDetail: window.urlDetail,

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

    detailData: {
      name: null,
      text: null
    },

    restoreState: function (data) {
      var obj = this;
      console.log('Init state from url', data);

      var count = [0].concat(Object.keys(data)).reduce((acc, key) => obj.steps.indexOf(key) !== -1 && data[key] ? acc + 1 : acc);

      console.log('Count = ', count);

      for (var i = 0; i < count - 1; i++) {
        var step = this.steps[i];
        this.currentData[step] = data[step];
      }

      if (this.currentData[this.steps[0]]) {
        // Разблокируем кнопку назад если шаг не первый
        $('#btnBack').prop('disabled', false);
      }

      // Загрузка данных с сервера
      this.updateData(function () {
        initStep();

        if (count) {
          var step = obj.steps[count - 1];
          obj.currentData[step] = data[step];
          obj.updateDetailData(step, data[step], showDetails);
        }
      });
    },

    updateCurrentData: function (type, value) {
      var isCurrent = false;
      Object.keys(data.currentData).forEach(key => {
        if (key === type) {
          data.currentData[key] = value;
        } else if (isCurrent) {
          data.currentData[key] = null;
        }
      })
    },

    updateDetailData: function (type, value, callback) {
      var obj = this;
      console.log(type, value)
      $.ajax({
        type: 'GET',
        url: this.urlDetail + '?' + $.param({ type, value }),
        success: function (res) {
          var data = JSON.parse(res);
          console.log(data);

          obj.detailData.name = data.name;
          obj.detailData.text = data.text;

          callback();
        }
      });
    },

    updateData: function (callback) {
      var obj = this;
      $.ajax({
        type: 'GET',
        url: this.url + '?' + $.param(this.currentData),
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

  function updateReportNextButtons() {
    if (data.currentData[data.steps[3]]) {
      // Если последний шаг
      $('#btnPrint').show();
      $('#btnNext').hide();
    } else {
      $('#btnPrint').hide();
      $('#btnNext').show();
    }
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
        $(`.nav-link[data-class="${step}"]`).addClass('active').removeClass('disabled');
        $('#wrapper').html(`<h4 class="text-center mt-5">${data.emptyText[step]}</h4>`);
      } else {
        $(`.nav-link[data-class="${step}"]`).html(
          data[step][data.currentData[step]]
        );
        $(`.nav-link[data-class="${step}"]`).addClass('disabled');
      }
    }

    updateReportNextButtons();
  }

  function showDetails() {
    $('#wrapper').html(`
      <h4 class="text-center mt-5">${data.detailData.name}</h4>
      <p>${data.detailData.text}</p>
    `);

    $('#btnNext').prop('disabled', false);
    updateReportNextButtons();
  }

  function toggleNextBtn() {
    $('#btnNext').prop('disabled', !$('#btnNext').prop('disabled'));
  }

  $('#btnBack').click(function () {
    console.log('Button back clicked');

    for (var i = data.steps.length - 1; i >= 0; i--) {
      var key = data.steps[i];

      if (data.currentData[key] !== null) {
        data.currentData[key] = null;
        if (i == 0) {
          $('#btnBack').prop('disabled', true);
        }
        break;
      }
    }

    $('#btnNext').prop('disabled', false);

    updateParams(data.currentData);
    data.updateData(initStep);
  });

  $('#btnNext').click(function () {
    $('#btnNext').prop('disabled', true);
    $('#btnBack').prop('disabled', false);

    data.updateData(initStep);
  });


  $(document).on('click', '.dropdown-item', function () {
    var value = $(this).attr('value');
    var type = $(this).parent().parent().children().first().attr('data-class');

    console.log(`Button was clicked. type='${type}', value='${value}'`);


    data.updateCurrentData(type, value);
    updateParams(data.currentData);
    data.updateDetailData(type, value, showDetails);
  });


  // Попытка восстановить состояние приложения после перезагрузки страницы
  data.restoreState(searchParamsToObject());

};
