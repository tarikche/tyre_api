import React, { useState, useEffect } from 'react';
import { API_URL } from '../config';

const Search = () => {
  const [searchTerm, setSearchTerm] = useState('');
  const [suggestions, setSuggestions] = useState([]);

  useEffect(() => {
    if (searchTerm) {
      fetchSuggestions();
    } else {
      setSuggestions([]);
    }
  }, [searchTerm]);

  const fetchSuggestions = async () => {
    console.log(searchTerm);
    try {
      const response = await fetch(`${API_URL}/api/tyre/search?term=${searchTerm}`);
      const data = await response.json();
      setSuggestions(data);
    } catch (error) {
        console.log('Response:', error.response);
      console.error('Error fetching suggestions:', error);
    }
  };


  const isInputEmpty = searchTerm === '';
  const ulClassName = isInputEmpty ? 'invisible' : '';

  return (
    <div class='mb-8 mt-64 flex flex-col items-center'>
      <input class='w-1/2 text-7xl p-5 rounded-full text-center bg-sky-100 tracking-wide '
        type="text"
        value={searchTerm}
        onChange={(e) => setSearchTerm(e.target.value)}
        placeholder="Search..."
      />
      <ul className={ulClassName}>
        {suggestions.map((suggestion, index) => (
          <li key={index}>{suggestion}</li>
        ))}
      </ul>
    </div>
  );
};

export default Search;
