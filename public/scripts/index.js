const TCPConnection = (send) => {
    let connection = new WebSocket('wss://healthandtourismturkey.com/ws');

    connection.onopen = function (e) {
        console.log("Connection established");
        connection.send(send);
    };

    connection.onmessage = function (e) {
        console.log(e.data);
    };

    connection.onerror = function (error) {
        console.error("WebSocket Error: ", error);
    };

    connection.onclose = function (e) {
        console.log("Connection closed");
    };
};

jQuery(document).ready(function () {
    TCPConnection('test');
});
