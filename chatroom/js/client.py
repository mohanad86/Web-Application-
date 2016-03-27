import requests
# requests is performing HTTP request
r = requests.get("http://push.koodur.com/ev/chatroom",
	headers={"Accept": "text/event-stream"}, stream=True)
 
for line in r.iter_lines():
    print "Got line:", line
