# Collection Manager

Collection Manager is a web-based application for storing and organizing
arbitrary collections of items.  For example, the application may be used to
store collections of books, movies, board games, IT assets, ties, recipes,
or tools. The user is in complete control to defined which **fields** a
collection consists of.

--------------------------------------------------------------------------------

## Requirements

- A collection manager **instance** contains **collections**.
- A **collection** contains **items**.
- **Items** are made up of **fields**.
- Each **field** holds a **value** of a specific **type** of data.
- **Fields** are configured via **properties** (depending on the **type**)
- **Types** of **fields** are added/configured via a plugin system.
- A **field** may be configured such that its **value** is unique (i.e., no
  other item in that collection may have the same **value** for the same
  **field**).
- The **fields** within an **item** are displayed in a user-defined **layout**.
- The **layout** describes which and where the **fields** in an **item** are
  displayed on the screen or page.
- Each **collection** is identified via an **instance**-unique
  **collection key**
- The **collection key** is an alphanumeric value of up to 8 characters starting
  with a letter where all characters are upper case. (e.g. TIES, ASSETS, FOO3)
- Each **item** in a collection is given a unique, auto-generated **item id**
- An **item** may be uniquely identified within an **instance** using a
  combination of the **collection key** and **item id** as so:
  [collection key]-[item id] (e.g., TIES-8, ASSETS-167)
- An **instance** may be accessed by **users**.
- A **user** accesses the **instance** via a username and password.
- A **user** may be a member of zero or more **groups**
- A **group** consists of zero or more **users**.
- A **user** or **group** may be granted **role-based** access to
  **collections** and the **instance**.
- A built-in public/anonymous **user** may be granted access to **collections** 
- **Fields** of a **type** such that the **value** must be a file (e.g., image)
  use a **file manager** to acess these **files**.
- Each **collection** contains a unique set of **files**
- Each **file** within a **collection** is given a unique, auto-generated
  **file id**.
- **Files** are uniquely identified using the same format as **items**.
- **Metadata** should be stored for each **item**
	- ID
	- Creation timestamp
	- Last update timestamp
	- Deletion timestamp
- **Metadata** may be displayed as a **field** like any other except that
  a **metadata** field is not user-defined/cannot be deleted.	
- Creates an **audit log** of all operations (excluding reading item data)
	- Timestamp - When did the operation occur? 
	- User - Who performed the operation?
	- Operation - What operation was performed?
	- Additional Data - Any additional data/information associated with the
	  operation.
- When deleted, an **item** is marked for deletion without the underlying
  data being immediately erased (i.e., trash feature)
	- Periodic **garbage collection** will be performed to fully erase an item
	  after a specified period.
- A **field** may be rendered/displayed in different formats depending upon its
  **type**.
- A **collection's** **items** may be exported to a CSV file
- A **collection** may be exprted to a ZIP archive which contains the items
  in a CSV file as well as files
- Ability to check for duplicate **files** by calculating the hash locally in
  the browser and performing a search by hash
- Quick **search** feature on the **items** list layout page that searches
  through the contents of all visible fields on the layout.
- Advanced **search** feature that allows search queries by specific 
  **field(s)**.

--------------------------------------------------------------------------------

## User Workflows

1. Create Collection
2. Create Fields
3. Create Layout(s)
4. Add Item(s)

--------------------------------------------------------------------------------

## Collections

**collection**
- key: VARCHAR(8), PRIMARY
- name: VARCHAR(32), PRIMARY
- description: STRING
- created_at: DATETIME

--------------------------------------------------------------------------------

## Fields

Use the EAV (Entity-Attribute-Value) database design pattern to strore data.
This is opposed to creating a separate table for each collection.

One of these item_value_... tables exists for each basic "type" of data/value to
be stored (e.g., VARCHAR, DATETIME, ...)

**item_value_[type]** (i.e., value)
- id: INT, PRIMARY, AUTOINCREMENT
- collection: VARCHAR(8), FOREIGN(collection.key)
- item: INT, FOREIGN(item.id)
- field: PRIMARY, FOREIGN(field.name)
- value: [type]

CREATE TABLE "item_value_text" (
	"id" INTEGER,
	"collection"	TEXT NOT NULL,
	"item"	INTEGER NOT NULL,
	"field"	TEXT NOT NULL,
	"value"	TEXT,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("collection","item") REFERENCES item("collection","id") ON DELETE CASCADE,
	FOREIGN KEY("collection", "field") REFERENCES field("collection","name") ON DELETE CASCADE
);

**field** (i.e., attribute)
- collection: VARCHAR(8), PRIMARY, FOREIGN(collection.key)
- name: VARCHAR(32), PRIMARY
- type: VARCHAR(32)
- properties: TEXT (JSON)
- created_at: DATETIME

**item** (i.e., entity)
- collection: VARCHAR(8), PRIMARY, FOREIGN(collection.key)
- id: INT, PRIMARY, AUTO-INCREMENT
- created_at: DATETIME
- modified_at: DATETIME
- deleted_at: DATETIME, NULL

--------------------------------------------------------------------------------

## Field Types

At a minimum, every field type must be able to be rendered in the following
formats/views:

- Edit
- View

Types may optionally allow rendering in different formats.

- Field
	- Short Text
	- Long Text
	- Integer Number
	- Real Number
	- Images
	- Files
	- Item Links
	- Selection
	- Color

### Field

Commonality between all fields

#### Properties

- Unique - Is this field's value unique?
- Required - Does this field require a non-empty value?



### Short Text

A short text field contains a single line of text.  It supports rich text via
HTML.
This field may be used to implement a hyperlink to an external resource

#### Value

The short text field stores its values as a string.

#### Properties

- Regex - A regular expression that the value must match



### Long Text

A long text field contains multiple lines of text.  It supports rich text via
HTML.

#### Value

The long text field type stores its values as a string

#### Properties

None



### Integer Number

A number field supports numeric integer values.

#### Value

The number field stores its value as an integer (a positive or negative whole
number).

#### Properties

- Minimum - The minimum value to which the field may be set (default: infinite)
- Maximum - The maximum value to which the field may be set (default: infinite)
- Step - The value must a multiple of the step (default: 1)



### Real Number

A number field supports any real (decimal or whole) number.

#### Value

The real number field stores it vakue as a double-precision floating point.



### Images

An images field is used to display one or more images/pictures.

#### Properties

- Maximum Images - The maximum number of images that may be displayed
  (from 1 to infinite)



### Item Links

A link field is used to create a link to another item within the same or a
different collection.

#### Properties

- Maximum Links - The maximum number of links that are accepted
  (from 1 to infinite)



### Selection

A selection field allows the user to choose a value from a pre-defined set.
It is sisplayed to the user as either a combo box (drop down box/select box)
or as a series of radio buttons (single selection) or check boxes (multiple
selection).

#### Properties

- Values - The list of pre-definied values between which the user can select
- Multiple - Can more than one value be selected?
- Expanded - Should the options be displayed as a drop down box (false) or
  as an expended list of radio/check boxes (true)?
  
  

### Color

The color field allows the user to select a color.

--------------------------------------------------------------------------------

## Core Value Types

Fields store and display values.  There may be an infinite number of different
types of fields that display their values in different ways.  However, a field's
value(s) must be stored in one of a set of standard "core value types." These
types map to the underlying database's storage primitives.

- Short String
- Long String
- Integer
- Double
- Timestamp

--------------------------------------------------------------------------------

## Files

### Attributes

- ID - The unique, auto-generated indetifier for the file
- Name - The original name of the file (including extension)
- MIME Type - The MIME type of the file
- Hash - A cryptographic hash of the file

### Filesystem Layout

Files are stored within the underlying filesystem in directories.  There exists
a directory for each collection.  The file is named only with its ID.

- resources
  - files
    - [collection key 0]
      - 0
      - 1
      - ...
      - N
    - [collection key 1]
    - ...
    - [collection key M]
    
--------------------------------------------------------------------------------

## Layouts

A layout defines how and which fields are displayed to the user.

Layouts have the following attributes:

- ID (auto-generated)
- Name
- Description
- Type

A layout may be one of the following "types":
- Table
- Dynamic
- Fixed

### Table Layout

In a list-type layout, items are organized into a table/list as rows and
columns.  There is one column for each field displayed by the layout and one
row for each item in the collection.  A table layout shows multiple items.

### Dynamic Layout

In a dynamic-type layout, an item is organized into a flexible and responsive
grid.  The user defines the number, location, and proportions of the fields
displayed within this grid.  A dynamic layout only shows a single item.  The
layout resizes proportionally depending on the display size.

### Fixed

In a fixed-type layout, an item's fields are placed at absolute positions
within a fixed sized window.  This type of layout is useful for creating
printable views with specific formatting.

--------------------------------------------------------------------------------

## Roles

- Instance
  - Create Collection
  - Delete Collection
  - Manager Users
- Collection
  - View Items
  - Create Items
  - Delete Items
  - Edit Items
  - Create Layout
  - Delete Layout
  
--------------------------------------------------------------------------------

## URLs

Display a collections layout for a specific item
[base]/collection/[collection tag]/layout/[layout id]?item=[item id]
[base]/collection/ASSETS/layout/0?item=ASSETS-168

--------------------------------------------------------------------------------

## Export

The exported CSV file will contain the raw values for fields.  If the field
requires a file, the CSV will contain only the ID of the file.  The files.csv
CSV will contain the file IDs, original names, and MIME types.


A collection may be exported to a self-contained package

- [collection key].zip
	- [collection key].csv
	- files
		- files.csv
		- 0
		- 1
		- ...
		- N
		
Or only the csv may be exported if desired

[collection key].zip