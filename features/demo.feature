Feature: Gestionar libros

  Scenario: Ver la lista de libros
    Given I am on "/books"
    Then I should see "List of Books"
    And I should see at least 1 "book-card"

  Scenario: Ver detalles de un libro
    Given I am on "/books/1"
    Then I should see "Book Details"
