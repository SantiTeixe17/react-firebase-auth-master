fetch('./api')
    .then(response => response.json())
    .then(data => {
        const usersDiv = document.getElementById('users');

        // Recorriendo y mostrando usuarios
        data.forEach(user => {
            const userContainer = document.createElement('div');
            userContainer.classList.add('user');

            const userInfo = document.createElement('div');
            userInfo.classList.add('user-info');

            const userName = document.createElement('p');
            userName.classList.add('user-name');
            userName.textContent = user.name;

            const userEmail = document.createElement('p');
            userEmail.classList.add('user-email');
            userEmail.textContent = user.email;

            const orderList = document.createElement('ul');
            orderList.classList.add('order-list');

            // Recorriendo y mostrando pedidos para cada usuario
            user.orders.forEach(order => {
                const orderItem = document.createElement('li');
                orderItem.classList.add('order');
                orderItem.textContent = `Pedido ID: ${order.id}, Total: ${order.total}`;
                orderList.appendChild(orderItem);
            });

            userInfo.appendChild(userName);
            userInfo.appendChild(userEmail);
            userContainer.appendChild(userInfo);
            userContainer.appendChild(orderList);
            usersDiv.appendChild(userContainer);
        });
    });