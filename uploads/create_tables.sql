-- Users Table (matching signup and login pages)
CREATE TABLE Users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,  -- Store hashed password
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL
);

-- Notes Table (reflecting dashboard note list)
CREATE TABLE Notes (
    note_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    last_edited TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    is_shared BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Note Sharing Table
CREATE TABLE NoteShares (
    share_id INT PRIMARY KEY AUTO_INCREMENT,
    note_id INT NOT NULL,
    shared_by_user_id INT NOT NULL,
    shared_with_user_id INT NOT NULL,
    shared_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (note_id) REFERENCES Notes(note_id),
    FOREIGN KEY (shared_by_user_id) REFERENCES Users(user_id),
    FOREIGN KEY (shared_with_user_id) REFERENCES Users(user_id)
);

-- Indexes for performance and quick lookups
CREATE INDEX idx_user_notes ON Notes(user_id);
CREATE INDEX idx_note_shares ON NoteShares(shared_by_user_id, shared_with_user_id);