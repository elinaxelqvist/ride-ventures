function validateComment() {
    const comment = document.getElementById('comment');
    const trimmedComment = comment.value.trim(); // Remove leading and trailing whitespaces

    if (trimmedComment.length === 0) {
        alert('Comments cannot be empty.');
        return false;
    }

    return true;
  }