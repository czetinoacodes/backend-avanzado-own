document.getElementById('cargar').addEventListener('click', () =>{
	fetch('http://127.0.0.1:8000/api/products/', { 
		headers: { 'Accept': 'application/json' }
	})
	.then(res => res.json())
	.then(data => {
		const ul = document.getElementById('lista');
		ul.innerHTML = '';
		data.data.forEach(p => {
			const li = document.createElement('li');
			li.textContent = `${p.nombre} - $${p.precio}`;
			ul.appendChild(li);
		});
	})
	.catch(err => console.error('Error: ', err));
});