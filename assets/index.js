function request(url) {
  return new Promise((resolve) => {
    const httpRequest = new XMLHttpRequest();

    httpRequest.open('GET', url);

    httpRequest.onload = () => {
      resolve(httpRequest);
    };

    httpRequest.send();
  });
}

document.querySelector('#first__btn').addEventListener('click', () => {
  const idClient = document.querySelector('select').value;
  const url = `http://localhost3/client_traffic_stat.php?id_client=${idClient}`;
  const promise = request(url);

  const output = document.querySelector('.first > #form__output');

  promise.then((xhrObject) => {
    const { clientName, inTraffic, outTraffic } = JSON.parse(xhrObject.response);
    const outputHTML = `<h4>Cтатистика работы в сети клиента ${clientName}:</h4>
    <p>Общее количество входящего трафика &#8212 ${inTraffic} KB</p>
    <p>Общее количество исходящего трафика &#8212 ${outTraffic} KB</p>`;

    output.innerHTML = outputHTML;
  });
});

document.querySelector('#second__btn').addEventListener('click', () => {
  const dateTimeInputElements = document.querySelectorAll('.datetime');
  const url = Array.from(dateTimeInputElements).reduce((str, elem) => {
    return `${str}${elem.name}=${elem.value}&`;
  }, 'http://localhost3/period_traffic_stat.php?');
  const promise = request(url);

  const output = document.querySelector('.second > #form__output');

  promise.then((xhrObject) => {
    output.innerHTML = xhrObject.response;
  });
});

document.querySelector('#third__btn').addEventListener('click', () => {
  const url = 'http://localhost3/negative_balance.php';
  const promise = request(url);

  const output = document.querySelector('.third > #form__output');
  const serializer = new XMLSerializer();

  promise.then((xhrObject) => {
    output.innerHTML = serializer.serializeToString(xhrObject.responseXML);
  });
});
