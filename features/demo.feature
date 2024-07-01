Feature: Gestionar libros

  Scenario: Ver la lista de libros
    Given I am on "/books"
    Then I should see "Books List"

  Scenario: Ver detalles de un libro
    Given I am on "/books/9"
    Then I should see "Book Details"
