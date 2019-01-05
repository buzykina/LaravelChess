<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('70108a32ac63f999e980', {
      cluster: 'eu',
      forceTLS: true
    });

    var channel = pusher.subscribe('channelDemoEvent');
    channel.bind('App\\Events\\eventTrigger', function(data) {
      alert(data);
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>