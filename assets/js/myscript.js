var url = location.href.replace(/https?:\/\//i, "");
console.log(url);
var baseUrl = 'localhost/ci_practice/';
var body = document.getElementsByTagName('body')[0];
var script = document.createElement('script');


switch(url){
	case baseUrl+'clients':
		script.src = 'assets/js/clients.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
   	case baseUrl+'products':
		script.src = 'assets/js/products.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
   	case baseUrl+'suppliers':
		script.src = 'assets/js/suppliers.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'products/category':
		script.src = '../assets/js/products.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'items/order':
		script.src = '../assets/js/order.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'items/incoming':
		script.src = '../assets/js/incoming.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'items/stocks':
		script.src = '../assets/js/stocks.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'items/retail':
		script.src = '../assets/js/retail.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'items/delivered':
		script.src = '../assets/js/delivered.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'grooming/grooming_list':
		script.src = '../assets/js/grooming.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'pets':
		script.src = 'assets/js/pets.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'pets/admission':
		script.src = '../assets/js/admission.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'pets/history':
		script.src = '../assets/js/history.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'pets/schedules':
		script.src = '../assets/js/schedule.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'pets/today_schedules':
		script.src = '../assets/js/schedule.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'pets/revenue':
		script.src = '../assets/js/revenue.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'items/sold_items':
		script.src = '../assets/js/sold.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'items/critical':
		script.src = '../assets/js/stocks.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'grooming/avail':
		script.src = '../assets/js/avail_grooming.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;
	case baseUrl+'grooming/revenue':
		script.src = '../assets/js/grooming_revenue.js';
		script.type = 'text/javascript';
		body.appendChild(script);
		break;

}