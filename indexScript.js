document.getElementById('comment-form').addEventListener('submit', function(event) {
    var nameInput = document.getElementsByName('first_name')[0];
    var commentInput = document.getElementsByName('review')[0];
    var nameError = document.getElementById('name-error');
    var commentError = document.getElementById('comment-error');
    
    nameError.innerHTML = '';
    commentError.innerHTML = '';

    if (nameInput.value.length < 3) {
      nameError.innerHTML = 'Ім\'я та прізвище повинні містити принаймні 3 символи.';
      event.preventDefault();
    }

    if (commentInput.value.length < 5  ) {
      commentError.innerHTML = 'Коментар повинен містити від 5   символів.';
      event.preventDefault();
    }
  });