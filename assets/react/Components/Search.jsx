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
    try {
        console.log('ekeksfkefekf');
      const response = await fetch(`${API_URL}/api/tyre/search/${searchTerm}`);
      const data = await response.json();
      setSuggestions(data.suggestions);
    } catch (error) {
        console.log('Response:', error.response);
      console.error('Error fetching suggestions:', error);
    }
  };

  return (
    <div class='mb-8 mt-64  flex justify-center'>
      <input class='w-4/7 text-8xl p-5 rounded-full text-center bg-sky-100 tracking-wide '
        type="text"
        value={searchTerm}
        onChange={(e) => setSearchTerm(e.target.value)}
        placeholder="Search..."
      />
      <ul>
        {suggestions.map((suggestion, index) => (
          <li key={index}>{suggestion}</li>
        ))}
      </ul>
    </div>
  );
};

export default Search;
