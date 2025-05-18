document.addEventListener('DOMContentLoaded', function() {
    let transactions = JSON.parse(localStorage.getItem('transactions')) || [];
    
    const form = document.getElementById('form');
    const textInput = document.getElementById('text');
    const amountInput = document.getElementById('amount');
    const categoryInput = document.getElementById('category');
    const dateInput = document.getElementById('date');
    const transactionsList = document.getElementById('transactions');
    const balanceElement = document.getElementById('balance');
    const incomeElement = document.getElementById('income-amount');
    const expenseElement = document.getElementById('expense-amount');
    const filterCategory = document.getElementById('filter-category');
    const filterMonth = document.getElementById('filter-month');
    
    const ctx = document.getElementById('chart').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [],
            datasets: [{
                data: [],
                backgroundColor: [
                    '#4BC0C0', '#9966FF', '#FF9F40', '#36A2EB',
                    '#FFCE56', '#FF6384', '#28a745', '#dc3545'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value.toFixed(2)} € (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (textInput.value.trim() === '' || amountInput.value.trim() === '' || categoryInput.value === '') {
            alert('Veuillez remplir tous les champs');
            return;
        }
        
        const transaction = {
            id: generateID(),
            text: textInput.value,
            amount: +amountInput.value,
            category: categoryInput.value,
            date: dateInput.value || new Date().toISOString().split('T')[0]
        };
        
        transactions.push(transaction);
        updateLocalStorage();
        addTransactionToDOM(transaction);
        updateValues();
        updateChart();
        
        textInput.value = '';
        amountInput.value = '';
        categoryInput.value = '';
        dateInput.value = '';
    });

    function generateID() {
        return Math.floor(Math.random() * 100000000);
    }
    
    function addTransactionToDOM(transaction) {
        const sign = transaction.amount < 0 ? '-' : '+';
        const item = document.createElement('li');
        const amountWithoutSign = Math.abs(transaction.amount);
        
        item.classList.add('transaction');
        item.classList.add(transaction.amount < 0 ? 'expense' : 'income');
        
        item.innerHTML = `
            <div class="details">
                ${transaction.text}
                <span class="category">${getCategoryName(transaction.category)}</span>
                <div class="date">${formatDate(transaction.date)}</div>
            </div>
            <span class="amount">${sign}${amountWithoutSign.toFixed(2)} €</span>
            <button class="delete-btn" onclick="removeTransaction(${transaction.id})"><i class="fas fa-trash"></i></button>
        `;
        
        transactionsList.appendChild(item);
    }
    
    function updateValues() {
        const amounts = transactions.map(transaction => transaction.amount);
        
        const total = amounts.reduce((acc, item) => (acc += item), 0).toFixed(2);
        const income = amounts
            .filter(item => item > 0)
            .reduce((acc, item) => (acc += item), 0)
            .toFixed(2);
        const expense = (
            amounts
                .filter(item => item < 0)
                .reduce((acc, item) => (acc += item), 0) * -1
        ).toFixed(2);
        
        balanceElement.innerText = `${total} €`;
        incomeElement.innerText = `+${income} €`;
        expenseElement.innerText = `-${expense} €`;
    }
    
    function updateChart() {
        const allCategories = {};
        
        transactions.forEach(transaction => {
            const category = getCategoryName(transaction.category);
            if (!allCategories[category]) {
                allCategories[category] = 0;
            }
            allCategories[category] += Math.abs(transaction.amount);
        });

        chart.data.labels = Object.keys(allCategories);
        chart.data.datasets[0].data = Object.values(allCategories);
        chart.update();
    }
    
    function removeTransaction(id) {
        transactions = transactions.filter(transaction => transaction.id !== id);
        updateLocalStorage();
        init();
    }
    
    function updateLocalStorage() {
        localStorage.setItem('transactions', JSON.stringify(transactions));
    }
    
    function init() {
        transactionsList.innerHTML = '';
        
        let filteredTransactions = [...transactions];
        
        if (filterCategory.value !== 'all') {
            filteredTransactions = filteredTransactions.filter(
                t => t.category === filterCategory.value
            );
        }
        
        if (filterMonth.value) {
            const [year, month] = filterMonth.value.split('-');
            filteredTransactions = filteredTransactions.filter(t => {
                const [tYear, tMonth] = t.date.split('-');
                return tYear === year && tMonth === month;
            });
        }
        
        filteredTransactions.forEach(addTransactionToDOM);
        updateValues();
        updateChart();
    }
    
    function getCategoryName(category) {
        const categories = {
            food: 'Nourriture',
            transport: 'Transport',
            housing: 'Logement',
            entertainment: 'Loisirs',
            shopping: 'Shopping',
            salary: 'Salaire',
            other: 'Autre'
        };
        return categories[category] || category;
    }
    
    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('fr-FR', options);
    }
    
    filterCategory.addEventListener('change', init);
    filterMonth.addEventListener('change', init);
    
    dateInput.value = new Date().toISOString().split('T')[0];
    filterMonth.value = new Date().toISOString().slice(0, 7);
    
    init();
    
    window.removeTransaction = removeTransaction;
});