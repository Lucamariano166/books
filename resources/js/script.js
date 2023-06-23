document.addEventListener('DOMContentLoaded', () => {
  const bookList = document.getElementById('book-list');
  const addBookForm = document.getElementById('add-book-form');

  // Função para buscar os livros da API e exibir na página
  const fetchBooks = () => {
    fetch('http://localhost:8000/api/books')
      .then(response => response.json())
      .then(data => {
        bookList.innerHTML = '';
        data.forEach(book => {
          const bookItem = document.createElement('div');
          bookItem.innerHTML = `
            <p>Name: ${book.name}</p>
            <p>ISBN: ${book.isbn}</p>
            <p>Value: $${book.value}</p>
            <hr>
          `;
          bookList.appendChild(bookItem);
        });
      })
      .catch(error => console.log(error));
  };

  // Função para adicionar um novo livro via API
  const addBook = (name, isbn, value) => {
    const data = {
      name: name,
      isbn: isbn,
      value: value
    };

    fetch('http://localhost:8000/api/books', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
      .then(response => response.json())
      .then(data => {
        console.log(data);
        fetchBooks();
      })
      .catch(error => console.log(error));
  };

  // Evento de envio do formulário de adição de livro
  addBookForm.addEventListener('submit', event => {
    event.preventDefault();

    const name = document.getElementById('name').value;
    const isbn = document.getElementById('isbn').value;
    const value = document.getElementById('value').value;

    addBook(name, isbn, value);
    addBookForm.reset();
  });

  // Buscar e exibir os livros ao carregar a página
  fetchBooks();
});
